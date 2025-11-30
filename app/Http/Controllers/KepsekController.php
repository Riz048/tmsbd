<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepsekController extends Controller
{
    public function dashboard()
    {
        return view('kepsek.dashboard');
    }

    public function manajemenAkun()
    {
        return view('kepsek.akun.index');
    }

    public function validasiAkademik()
    {
        return view('kepsek.validasi.index');
    }

    public function laporan()
    {
        return view('kepsek.laporan.index');
    }
}
