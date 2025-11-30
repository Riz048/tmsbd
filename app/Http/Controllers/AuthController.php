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

        // Jika user tidak ada atau password salah
        if (!$user || !password_verify($request->password, $user->password)) {
            return back()->with('login_error', 'Username atau password salah.');
        }

        // Simpan user ke session
        session([
            'logged_in' => true,
            'user_id'   => $user->id_user,
            'role'      => $user->role,
            'user_name' => $user->nama,
        ]);

        // Redirect berdasarkan role
        switch ($user->role) {

            case 'siswa':
            case 'guru':
                return redirect('/');

            case 'petugas':
                return redirect('/petugas/dashboard');

            case 'kep_perpus':
                return redirect('/kepperpus/dashboard');

            case 'kepsek':
                return redirect('/kepsek/dashboard');

            default:
                session()->flush();
                return redirect('/login')->withErrors(['login' => 'Role tidak dikenali.']);
        }
    }

    public function logout(Request $request)
    {
        session()->flush();
        return redirect('/login');
    }
}
