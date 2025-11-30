<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class KepalaPerpusController extends Controller
{
    public function dashboard()
    {
        return view('kepperpus.dashboard');
    }

    public function dataPetugas()
    {
        return view('kepperpus.petugas.index');
    }

    public function laporanPeminjaman()
    {
        return view('kepperpus.laporan.peminjaman');
    }

    public function laporanPengembalian()
    {
        return view('kepperpus.laporan.pengembalian');
    }
}
