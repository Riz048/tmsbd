<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function login()
    {
        return view('auth.login');
    }

    public function authenticate(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required',
        ]);

        // Cari user berdasarkan username
        $user = User::where('username', $request->username)->first();

        // Kalau tidak ditemukan atau password beda → gagal
        if (!$user || $user->password !== $request->password) {
            return back()->withErrors(['login' => 'Username atau password salah.']);
        }

        // Simpan user ke session manual
        session([
            'logged_in' => true,
            'user_id'   => $user->id_user,
            'role'      => $user->role,
            'user_name' => $user->nama,
        ]);

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        session()->forget('logged_in');
        session()->forget('user_id');
        session()->forget('role');
        session()->forget('user_name');

        $request->session()->flush();

        return redirect('/login');
    }
}
