<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PetugasController extends Controller
{
    public function dashboard()
    {
        return view('petugas.dashboard');
    }

    public function tambahBuku()
    {
        return view('petugas.buku.tambah');
    }

    public function simpanBuku(Request $request)
    {
        // isi nanti
    }

    public function peminjaman()
    {
        return view('petugas.peminjaman.index');
    }

    public function pengembalian()
    {
        return view('petugas.pengembalian.index');
    }
}
