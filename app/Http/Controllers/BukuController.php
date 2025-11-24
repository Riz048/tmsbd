<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class BukuController extends Controller
{
    // List buku
    public function index()
    {
        // Jika user login
        if (auth()->check()) {
            $role = auth()->user()->role;

            // Siswa
            if ($role === 'siswa') {
                $kelas = auth()->user()->kelas_akademik ?? null;

                $buku = Buku::when($kelas, function ($q) use ($kelas) {
                        $q->where('kelas_akademik', $kelas)
                          ->orWhereNull('kelas_akademik'); // buku bacaan
                    })
                    ->get();

            } 
            
            // Guru
            elseif ($role === 'guru') {
                $buku = Buku::all();
            } 
            
            // Role lain
            else {
                $buku = Buku::all();
            }

        } else {
            // Guest: hanya boleh lihat buku bacaan
            $buku = Buku::whereNull('kelas_akademik')->get();
        }

        return view('user.beranda', compact('buku'));
    }

    // Detail buku
    public function detail($id)
    {
        $buku = Buku::findOrFail($id);
        return view('user.referensi.detail.detail-buku', compact('buku'));
    }
}
