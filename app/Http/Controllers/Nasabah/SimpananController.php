<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\PengajuanPinjaman;
use Barryvdh\DomPDF\Facade\Pdf;

class SimpananController extends Controller{
    public function simpanan()
    {
        $nasabahId = session('nasabah_id');

        $data = DB::table('simpanan')
            ->where('id_user', $nasabahId)
            ->orderBy('tanggal', 'desc')
            ->get();

        return view('nasabah.simpanan.index', compact('data'));
    }

    public function tambahSimpanan(Request $request)
    {
        $request->validate([
            'jenis' => 'required|in:wajib,sukarela',
            'nominal' => 'required|numeric|min:1000',
            'bukti' => 'nullable|image|max:2048'
        ]);

        $fileName = null;
        if ($request->hasFile('bukti')) {
            $fileName = time() . '_' . $request->file('bukti')->getClientOriginalName();
            $request->file('bukti')->move(public_path('bukti'), $fileName);
        }

        DB::table('simpanan')->insert([
            'id_user' => session('nasabah_id'),
            'jenis' => $request->jenis,
            'nominal' => $request->nominal,
            'tanggal' => now(),
            'status' => 'MENUNGGU',
            'bukti' => $fileName
        ]);

        return back()->with('success', 'Simpanan berhasil diajukan dan menunggu verifikasi.');
    }

    public function exportSimpananPDF()
    {
        $nasabahId = session('nasabah_id');
        $data = DB::table('simpanan')
                ->where('id_user', $nasabahId)
                ->get();

        $pdf = Pdf::loadView('nasabah.simpanan_pdf', compact('data'));
        return $pdf->download('riwayat_simpanan.pdf');
    }

}