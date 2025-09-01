<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class LaporanController extends Controller
{
    public function laporanSimpanan()
    {
        $simpanan = DB::table('simpanan')
            ->join('m_pelanggan', 'simpanan.id_user', '=', 'm_pelanggan.kd')
            ->select('m_pelanggan.nama', 'simpanan.jenis', DB::raw('SUM(simpanan.nominal) as total'))
            ->where('simpanan.status', 'DITERIMA')
            ->groupBy('simpanan.id_user', 'simpanan.jenis', 'm_pelanggan.nama')
            ->get();

        return view('admin.laporan.simpanan', compact('simpanan'));
    }

    public function exportSimpananPdf()
    {
        $simpanan = DB::table('simpanan')
            ->join('m_pelanggan', 'simpanan.id_user', '=', 'm_pelanggan.kd')
            ->select('simpanan.*', 'm_pelanggan.nama')
            ->get();

        $pdf = PDF::loadView('admin.laporan.simpanan_pdf', compact('simpanan'));
        return $pdf->download('laporan_simpanan.pdf');
    }

    public function laporanPinjaman()
    {
        $pinjaman = DB::table('pengajuan_pinjaman')
            ->join('m_pelanggan', 'pengajuan_pinjaman.id_user', '=', 'm_pelanggan.kd')
            ->select('m_pelanggan.nama', 'pengajuan_pinjaman.jenis_pinjaman', 'pengajuan_pinjaman.nominal', 'pengajuan_pinjaman.status')
            ->get();

        return view('admin.laporan.pinjaman', compact('pinjaman'));
    }

    public function exportPinjamanPdf()
    {
        $pinjaman = DB::table('pengajuan_pinjaman')
            ->join('m_pelanggan', 'pengajuan_pinjaman.id_user', '=', 'm_pelanggan.kd')
            ->select('pengajuan_pinjaman.*', 'm_pelanggan.nama')
            ->get();

        $pdf = PDF::loadView('admin.laporan.pinjaman_pdf', compact('pinjaman'));
        return $pdf->download('laporan_pinjaman.pdf');
    }

}
