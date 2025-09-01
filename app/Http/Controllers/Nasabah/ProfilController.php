<?php

namespace App\Http\Controllers\Nasabah;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;

class ProfilController extends Controller
{
    public function profil()
    {
        $nasabah = DB::table('m_pelanggan')->where('kd', session('nasabah_id'))->first();
        return view('nasabah.profil', compact('nasabah'));
    }

    public function editProfil()
    {
        $nasabah = DB::table('m_pelanggan')->where('kd', session('nasabah_id'))->first();
        return view('nasabah.edit_profil', compact('nasabah'));
    }

    public function updateProfil(Request $request)
    {
        $request->validate([
            'nama' => 'required|string|max:255',
            'alamat' => 'nullable|string',
            'telp' => 'nullable|string|max:20',
        ]);

        DB::table('m_pelanggan')->where('kd', session('nasabah_id'))->update([
            'nama' => $request->nama,
            'alamat' => $request->alamat,
            'telp' => $request->telp,
        ]);

        return redirect()->route('nasabah.profil')->with('success', 'Profil berhasil diperbarui.');
    }

    public function formGantiPassword()
    {
        return view('nasabah.ganti_password');
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'password_lama' => 'required',
            'password_baru' => 'required|min:5',
            'konfirmasi_password' => 'same:password_baru',
        ]);

        $nasabah = DB::table('m_pelanggan')->where('kd', session('nasabah_id'))->first();

        if (!$nasabah || $nasabah->password !== md5($request->password_lama)) {
            return back()->with('error', 'Password lama tidak sesuai!');
        }

        DB::table('m_pelanggan')->where('kd', $nasabah->kd)->update([
            'password' => md5($request->password_baru)
        ]);

        return redirect()->route('nasabah.profil')->with('success', 'Password berhasil diperbarui.');
    }

}