<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use Barryvdh\DomPDF\Facades\Pdf;

class PinjamanController extends Controller
{
    public function index()
    {
        $nasabahId = session('nasabah_id');

        $riwayat = PengajuanPinjaman::where('id_user', $nasabahId)->orderBy('postdate', 'desc')->get();

        return view('nasabah.pinjaman', compact('riwayat'));
    }

    public function form()
    {
        return view('nasabah.form_pinjaman');
    }

    public function ajukan(Request $request)
    {
        $request->validate([
            'jenis_pinjaman' => 'required',
            'peruntukan' => 'required',
            'nominal' => 'required|numeric',
            'jangka_waktu' => 'required|numeric',
            'satuan_waktu' => 'required',
            'jatuh_tempo_tanggal' => 'required|numeric',
        ]);

        $biayaJasa = 1000000; // Bisa ubah logika perhitungan
        $biayaProvisi = 0;
        $biayaLain = 0;
        $totalDiterima = $request->nominal - ($biayaJasa + $biayaProvisi + $biayaLain);

        PengajuanPinjaman::create([
            'kd' => Str::uuid(),
            'id_user' => session('nasabah_id'),
            'jenis_pinjaman' => $request->jenis_pinjaman,
            'peruntukan' => $request->peruntukan,
            'nominal' => $request->nominal,
            'jangka_waktu' => $request->jangka_waktu,
            'satuan_waktu' => $request->satuan_waktu,
            'jatuh_tempo_tanggal' => $request->jatuh_tempo_tanggal,
            'biaya_jasa' => $biayaJasa,
            'biaya_provisi' => $biayaProvisi,
            'biaya_lain' => $biayaLain,
            'total_diterima' => $totalDiterima,
            'status' => 'pending'
        ]);

        return redirect()->route('nasabah.pinjaman')->with('success', 'Pengajuan berhasil diajukan.');
    }

    public function detail($kd)
    {
        $pinjaman = DB::table('pengajuan_pinjaman')
            ->join('m_pelanggan', 'm_pelanggan.kd', '=', 'pengajuan_pinjaman.id_user')
            ->where('pengajuan_pinjaman.kd', $kd)
            ->select('pengajuan_pinjaman.*', 'm_pelanggan.nama')
            ->first();

        $angsuranLunas = DB::table('angsuran')
            ->where('pengajuan_kd', $kd)
            ->where('status', 'SUDAH')
            ->orderBy('ke')
            ->get();

        $angsuranBelum = DB::table('angsuran')
            ->where('pengajuan_kd', $kd)
            ->where('status', 'BELUM')
            ->orderBy('ke')
            ->get();

        return view('nasabah.pinjaman.detail', compact('pinjaman', 'angsuranLunas', 'angsuranBelum'));
    }

    public function formBayar($id) {
        $angsuran = DB::table('angsuran')->where('id', $id)->first();
        return view('nasabah.pinjaman.bayar', compact('angsuran'));
    }
    
    public function prosesBayar(Request $request, $id) {
        $request->validate([
            'bukti' => 'required|image|max:2048',
        ]);
    
        $file = $request->file('bukti');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->move(public_path('bukti'), $filename);
    
        DB::table('angsuran')->where('id', $id)->update([
            'bukti_pembayaran' => $filename,
            'verifikasi' => 'PENDING',
        ]);
    
        return redirect()->route('nasabah.dashboard')->with('success', 'Bukti pembayaran berhasil dikirim. Menunggu verifikasi admin.');
    }

    public function riwayat()
    {
        $nasabahId = session('nasabah_id');

        $angsuran = DB::table('angsuran')
            ->join('pengajuan_pinjaman', 'pengajuan_pinjaman.kd', '=', 'angsuran.pengajuan_kd')
            ->where('pengajuan_pinjaman.id_user', $nasabahId)
            ->where('angsuran.status', 'SUDAH')
            ->orderByDesc('angsuran.tanggal_bayar')
            ->select('angsuran.*', 'pengajuan_pinjaman.jenis_pinjaman')
            ->get();

        return view('nasabah.riwayat.index', compact('angsuran'));
    }

    public function exportPinjamanPDF()
    {
        $nasabahId = session('nasabah_id');
        $riwayat = DB::table('pengajuan_pinjaman')
                ->where('nasabah_id', $nasabahId)
                ->get();

        $pdf = Pdf::loadView('nasabah.pinjaman_pdf', compact('riwayat'));
        return $pdf->download('riwayat_pinjaman.pdf');
    }

}