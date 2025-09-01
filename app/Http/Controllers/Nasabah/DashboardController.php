<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class DashboardController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        return view('nasabah.dashboard', [
            'user' => $user,
        ]);
    }

    public function dashboard()
    {
        $nasabahId = Session::get('nasabah_id');

        $nasabah = DB::table('m_pelanggan')->where('kd', $nasabahId)->first();

        // Total saldo simpanan pokok & wajib
        $saldoPokok = DB::table('simpanan')
            ->where('id_user', $nasabahId)
            ->sum('nominal');

        $saldoWajib = DB::table('simpanan')
            ->where('id_user', $nasabahId)
            ->sum('nominal');

        // Total pinjaman diajukan
        $pinjamanTerpakai = DB::table('pengajuan_pinjaman')
            ->where('id_user', $nasabahId)
            ->where('status', 'DISETUJUI')
            ->sum('nominal');

        // Pinjaman aktif (yang belum lunas)
        $pinjamanAktif = DB::table('pengajuan_pinjaman')
            ->where('id_user', $nasabahId)
            ->where('status', 'DISETUJUI')
            ->count();

        // Pinjaman lunas dihitung dari angsuran lunas
        $pinjamanLunas = DB::table('angsuran')
            ->where('pengajuan_kd', $nasabahId)
            ->where('status', 'LUNAS')
            ->count();

        // Aktivitas terakhir: simpanan dan angsuran
        $aktivitas = DB::table('simpanan')
            ->where('id_user', $nasabahId)
            ->select('tanggal as tanggal', DB::raw("'Setoran Simpanan' as jenis"), 'jenis as nominal')
            ->unionAll(
            DB::table('angsuran')
                ->where('pengajuan_kd', $nasabahId)
                ->select('tanggal_bayar as tanggal', DB::raw("'Pembayaran Angsuran' as jenis"), 'status')
            )
            ->orderBy('tanggal', 'desc')
            ->limit(5)
            ->get();

        return view('nasabah.dashboard', [
            'nasabah' => $nasabah,
            'saldoPokok' => $saldoPokok,
            'saldoWajib' => $saldoWajib,
            'limitPinjaman' => 100000000, // tetap hardcoded jika tidak ada field khusus
            'pinjamanTerpakai' => $pinjamanTerpakai,
            'pinjamanAktif' => $pinjamanAktif,
            'pinjamanLunas' => $pinjamanLunas,
            'aktivitas' => $aktivitas
        ]);
    }
}