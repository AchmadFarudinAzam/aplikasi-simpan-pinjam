<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class RegistrasiController extends Controller
{
    public function index(){
        return view('registrasi');
    }
    
    public function create(){
        return view('registrasi.create');
    } 
    
    public function store(Request $request){
        $request->validate([
            'kode' => 'required|unique:m_pelanggan,kode',
            'nama' => 'required|string|max:255',
            'password' => 'required|min:5',
            'jabatan' => 'required|string',
            'telp' => 'required',
        ]);

        DB::table('m_pelanggan')->insert([
            'kd' => Str::uuid(),
            'kode' => $request->kode,
            'nama' => $request->nama,
            'jabatan' => $request->jabatan,
            'telp' => $request->telp,
            'password' => Hash::make($request->password),
            'postdate' => now(),
        ]);

        return redirect()->route('registrasi.index')->with('Berhasil mendaftar');
        
    }
}
