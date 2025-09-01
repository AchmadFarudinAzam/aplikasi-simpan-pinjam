<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Admin;
use App\Models\Nasabah;
use App\Models\PengajuanPinjaman;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class AdminController extends Controller
{
    public function dashboard()
    {
        // 1. Total Simpanan
        $totalSimpanan = DB::table('simpanan')
            ->sum(DB::raw('jenis'));

        // 2. Total Pinjaman
        $totalPinjaman = DB::table('pengajuan_pinjaman')
            ->where('status', 'DISETUJUI')
            ->sum('nominal');

        // 3. Setoran Terbaru
        $setoranTerbaru = DB::table('simpanan')
            ->orderByDesc('tanggal')
            ->limit(1)
            ->value(DB::raw('jenis'));

        // 4. Nasabah Baru Bulan Ini
        $nasabahBaru = DB::table('m_pelanggan')
            ->orderBy('postdate')
            ->count();

        // 5. Grafik Pinjaman per Jenis
        $dataPinjaman = DB::table('pengajuan_pinjaman')
            ->select('jenis_pinjaman', DB::raw('SUM(nominal) as total'))
            ->where('status', 'DISETUJUI')
            ->groupBy('jenis_pinjaman')
            ->get();

        $labelPinjaman = $dataPinjaman->pluck('jenis_pinjaman')->toArray();
        $jumlahPinjaman = $dataPinjaman->pluck('total')->toArray();

        // 6. Grafik Simpanan per Bulan (12 bulan terakhir)
        $dataSimpanan = DB::table('simpanan')
        ->select(
            DB::raw('DATE_FORMAT(tanggal, "%Y-%m") AS bulan'),
            DB::raw('SUM(jenis) AS total')
        )
        ->groupBy(DB::raw('DATE_FORMAT(tanggal, "%Y-%m")'))
        ->orderBy(DB::raw('DATE_FORMAT(tanggal, "%Y-%m")'), 'ASC')
        ->limit(12)
        ->get();

        $labelSimpanan = $dataSimpanan->pluck('bulan')->toArray();
        $jumlahSimpanan = $dataSimpanan->pluck('total')->toArray();

        // 7. Tabel Ringkas - Laporan Pinjaman
        $dataTabelPinjaman = DB::table('pengajuan_pinjaman')
            ->join('m_pelanggan', 'pengajuan_pinjaman.id_user', '=', 'm_pelanggan.kd')
            ->select('m_pelanggan.nama', 'pengajuan_pinjaman.jenis_pinjaman', 'pengajuan_pinjaman.status', 'pengajuan_pinjaman.nominal')
            ->orderByDesc('pengajuan_pinjaman.id_user')
            ->limit(10)
            ->get();

        // 8. Tabel Ringkas - Laporan Simpanan
        $dataTabelSimpanan = DB::table('simpanan')
            ->join('m_pelanggan', 'simpanan.id_user', '=', 'm_pelanggan.kd')
            ->select('m_pelanggan.nama',
                DB::raw('SUM(jenis) as pokok'),
                DB::raw('SUM(jenis) as wajib'),
                DB::raw('SUM(jenis) as sukarela'),
                DB::raw('SUM(jenis) as total'))
            ->groupBy('m_pelanggan.nama')
            ->orderByDesc('total')
            ->limit(10)
            ->get();

        return view('admin.dashboard', [
            'totalSimpanan' => $totalSimpanan,
            'totalPinjaman' => $totalPinjaman,
            'setoranTerbaru' => $setoranTerbaru ?? 0,
            'nasabahBaru' => $nasabahBaru,
            'labelPinjaman' => $labelPinjaman,
            'dataPinjaman' => $jumlahPinjaman,
            'labelSimpanan' => $labelSimpanan,
            'dataSimpanan' => $jumlahSimpanan,
            'pinjaman' => $dataTabelPinjaman,
            'simpanan' => $dataTabelSimpanan,
        ], compact('labelSimpanan', 'jumlahSimpanan', 'labelPinjaman', 'jumlahPinjaman'));
    }
}