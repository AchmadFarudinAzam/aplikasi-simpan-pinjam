<?php

namespace App\Exports;

use App\Models\User;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class PinjamanExport implements FromView
{
    public function view(): View
    {
        $data = User::with('pinjaman')->where('role', 'nasabah')->get();
        return view('admin.laporan.pinjaman_excel', compact('data'));
    }
}