<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tabungan;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TabunganController extends Controller
{
    public function index()
    {
        $data = Tabungan::with('nasabah')->orderByDesc('tanggal')->get();
        return view('admin.tabungan.index', compact('data'));
    }

    public function create()
    {
        $nasabah = User::where('role', 'nasabah')->get();
        return view('admin.tabungan.create', compact('nasabah'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'pelanggan_kd' => 'required',
            'tanggal' => 'required|date',
            'keterangan' => 'required',
            'tipe' => 'required|in:debet,kredit',
            'nominal' => 'required|numeric|min:1',
        ]);

        Tabungan::create([
            'kd' => Str::uuid(),
            'pelanggan_kd' => $request->pelanggan_kd,
            'tanggal' => $request->tanggal,
            'keterangan' => $request->keterangan,
            'tipe' => $request->tipe,
            'nominal' => $request->nominal,
        ]);

        return redirect()->route('admin.tabungan.index')->with('success', 'Data ditambahkan.');
    }
}