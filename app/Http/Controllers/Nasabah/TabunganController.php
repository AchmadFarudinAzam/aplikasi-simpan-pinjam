<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Tabungan;

class TabunganController extends Controller
{
    public function index()
    {
        $user = Auth::user();

        $riwayat = Tabungan::where('pelanggan_kd', $user->kd)
                    ->orderBy('tanggal', 'desc')
                    ->get();

        return view('nasabah.tabungan', compact('user', 'riwayat'));
    }
}