<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Admin;
use App\Models\Nasabah;

class AuthController extends Controller
{
    public function loginAdmin() {
        return view('auth.login_admin');
    }

    public function prosesLoginAdmin(Request $request) {
        $username = $request->input('usernamex');
        $password = $request->input('passwordx');

    $admin = DB::table('adminx')
        ->where('usernamex', $username)
        ->where('passwordx', md5($password))
        ->first();

    if ($admin) {
        session(['admin_id' => $admin->kd]);
        return redirect()->route('admin.dashboard');
    } else {
        return back()->with('error', 'Login Admin gagal!');
    }
    }

    public function loginNasabah() {
        return view('auth.login_nasabah');
    }

    public function prosesLoginNasabah(Request $request) {

        $nama = $request->input('nama');
        $password = $request->input('password');
        
        $nasabah = DB::table('m_pelanggan')
        ->where('nama', $nama)
        ->first();

        if ($nasabah && Hash::check($password, $nasabah->password)) {
            session(['nasabah_id' => $nasabah->kd]);
            return redirect()->route('nasabah.dashboard');
        } else{
            return back()->with('error', 'Login Nasabah gagal!');
        }
    }

    public function logoutAdmin(Request $request)
    {
        $request->session()->forget('admin_id');
        return redirect()->route('admin.login')->with('success', 'Anda telah logout.');
    }

    public function logoutNasabah(Request $request)
    {
        $request->session()->forget('nasabah_id');
        return redirect()->route('nasabah.login')->with('success', 'Anda telah logout.');
    }

}