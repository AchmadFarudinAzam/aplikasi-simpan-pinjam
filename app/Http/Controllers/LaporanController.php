<?php

use App\Models\User;
use App\Models\Pinjaman;
use PDF;
use Excel;
use App\Exports\PinjamanExport;

public function pinjaman()
{
    $nasabah = User::where('role', 'nasabah')->get();

    $data = $nasabah->map(function ($n) {
        $total = $n->pinjaman->sum('nominal');

        return [
            'nama' => $n->nama,
            'kode' => $n->kode,
            'total_pinjaman' => $total,
        ];
    });

    return view('admin.laporan.pinjaman', compact('data'));
}

public function exportPDF()
{
    $data = User::with('pinjaman')->where('role', 'nasabah')->get();

    $pdf = PDF::loadView('admin.laporan.pinjaman_pdf', compact('data'));
    return $pdf->download('laporan-pinjaman.pdf');
}

public function exportExcel()
{
    return Excel::download(new PinjamanExport, 'laporan-pinjaman.xlsx');
}