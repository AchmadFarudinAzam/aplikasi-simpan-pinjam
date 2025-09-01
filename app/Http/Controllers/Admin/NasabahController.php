<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\Nasabah;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class NasabahController extends Controller
{
    public function index()
    {
        $nasabah = Nasabah::orderby('postdate', 'desc')->take(10)->get();
        
        //notif admin
        $jumlahPengajuanBaru = DB::table('pengajuan_pinjaman')
            ->where('status', 'Menunggu')
            ->count();

        $jumlahPembayaranPending = DB::table('angsuran')
            ->where('verifikasi', 'Pending')
            ->count();

        $jumlahNasabahBaru = DB::table('m_pelanggan')
            ->whereNull('postdate')
            ->count();

        return view('admin.nasabah.index', compact('nasabah', 
            'jumlahPengajuanBaru', 
            'jumlahPembayaranPending', 
            'jumlahNasabahBaru'));
    }

    public function create()
    {
        return view('admin.nasabah.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode' => 'required|unique:m_pelanggan,kode',
            'nama' => 'required',
            'jabatan' => 'required',
            'password' => 'required|min:6',
        ]);

        User::create([
            'kd' => Str::uuid(),
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'telp' => $request->telp,
            'password' => Hash::make($request->password),
            'role' => 'nasabah',
        ]);

        return redirect()->route('admin.nasabah.index')->with('success', 'Nasabah berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $nasabah = User::findOrFail($id);
        return view('admin.nasabah.edit', compact('nasabah'));
    }

    public function update(Request $request, $id)
    {
        $nasabah = User::findOrFail($id);

        $request->validate([
            'kode' => 'required|unique:m_pelanggan,kode,' . $nasabah->id . ',kd',
            'nama' => 'required',
            'jabatan' => 'required',
        ]);

        $nasabah->update([
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'telp' => $request->telp,
        ]);

        return redirect()->route('admin.nasabah.index')->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy($kd)
    {
        Nasabah::where('kd', $kd)->delete();
        return back()->with('success', 'Data nasabah dihapus.');
    }

    // Menampilkan daftar pengajuan pinjaman yang menunggu persetujuan
    public function daftarPengajuan()
    {
        $pengajuan = DB::table('pengajuan_pinjaman')
            ->join('m_pelanggan', 'pengajuan_pinjaman.id_user', '=', 'm_pelanggan.kd')
            ->select('pengajuan_pinjaman.*', 'm_pelanggan.nama')
            ->get();
        
        return view('admin.pengajuan.index', compact('pengajuan'));
    }

    // Untuk proses konfirmasi
    public function konfirmasiPengajuan(Request $request, $kd)
    {
        $request->validate([
            'status' => 'required|in:DISETUJUI,DITOLAK',
        ]);

        DB::table('pengajuan_pinjaman')
            ->where('kd', $kd)
            ->update([
                'status' => $request->status,
                'tanggal_disetujui' => $request->status === 'DISETUJUI' ? Carbon::now() : null,
            ]);

        // Jika disetujui, generate angsuran otomatis
        if ($request->status === 'DISETUJUI') {
            $this->generateAngsuran($kd);
        }

        return redirect()->back()->with('success', 'Status pengajuan berhasil diperbarui.');
    }

    protected function generateAngsuran($pengajuanKd)
    {
        $pinjaman = DB::table('pengajuan_pinjaman')->where('kd', $pengajuanKd)->first();

        if (!$pinjaman) return;

        $angsuranPokok = ($pinjaman->nominal + $pinjaman->biaya_jasa) / $pinjaman->jangka_waktu;

        for ($i = 1; $i <= $pinjaman->jangka_waktu; $i++) {
            $tanggalBayar = Carbon::parse($pinjaman->tanggal_disetujui)
                ->add($pinjaman->satuan_waktu === 'BULAN' ? $i . ' months' : $i . ' days');

            DB::table('angsuran')->insert([
                'pengajuan_kd' => $pengajuanKd,
                'ke' => $i,
                'jumlah_pokok' => $angsuranPokok,
                'biaya_lain' => 0,
                'total_dibayar' => 0,
                'status' => 'BELUM',
                'tanggal_bayar' => $tanggalBayar,
            ]);
        }
    }

    // Menampilkan daftar angsuran yang perlu diverifikasi
    public function verifikasiAngsuran()
    {
        $angsuran = DB::table('angsuran')
            ->join('pengajuan_pinjaman', 'angsuran.pengajuan_kd', '=', 'pengajuan_pinjaman.kd')
            ->join('m_pelanggan', 'pengajuan_pinjaman.id_user', '=', 'm_pelanggan.kd')
            ->where('angsuran.verifikasi', 'PENDING')
            ->select(
                'angsuran.id',
                'angsuran.ke',
                'angsuran.jumlah_pokok',
                'angsuran.bukti_pembayaran',
                'angsuran.verifikasi',
                'm_pelanggan.nama',
                'pengajuan_pinjaman.jenis_pinjaman',
                )
            ->get();

        return view('admin.pengajuan.verifikasi_bayar', compact('angsuran'));
    }

    // Menangani aksi verifikasi
    public function konfirmasiAngsuran(Request $request, $id)
    {
        $request->validate([
            'aksi' => 'required|in:DITERIMA,DITOLAK',
        ]);

        $status = $request->input('aksi') === 'DITERIMA' ? 'SUDAH' : 'BELUM';

        DB::table('angsuran')->where('id', $id)->update([
            'verifikasi' => $request->input('aksi'),
            'status' => $status,
            'tanggal_bayar' => $status === 'SUDAH' ? now() : null,
        ]);

        return back()->with('success', 'Verifikasi berhasil diproses.');
    }

    //verifikasi simpanan
    public function verifikasiSimpanan()
    {
        $simpanan = DB::table('simpanan')
            ->join('m_pelanggan', 'simpanan.id_user', '=', 'm_pelanggan.kd')
            ->select('simpanan.*', 'm_pelanggan.nama')
            ->where('simpanan.status', 'MENUNGGU')
            ->orderBy('simpanan.tanggal', 'desc')
            ->get();

        return view('admin.simpanan.verifikasi', compact('simpanan'));
    }

    public function konfirmasiSimpanan(Request $request, $id)
    {
        $aksi = $request->input('aksi');

        DB::table('simpanan')->where('id', $id)->update([
            'status' => $aksi
        ]);

        return back()->with('success', "Simpanan berhasil $aksi.");
    }

}