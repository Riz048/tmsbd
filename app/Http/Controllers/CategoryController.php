<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function show(Request $request, $tipe)
    {
        $kategori = $request->query('kategori');
        $query = Buku::query();

        // Filter fiksi / non-fiksi
        $query->where('tipe_bacaan', $tipe);

        // FIlter role
        if (auth()->check()) {
            $role = auth()->user()->role;

            //  Siswa - Filter kelas
            if ($role === 'siswa') {
                $kelas = auth()->user()->kelas_akademik;

                $query->where(function ($q) use ($kelas) {
                    $q->where('kelas_akademik', $kelas)
                      ->orWhereNull('kelas_akademik'); // buku bacaan
                });
            }

            // Guru
            else if ($role === 'guru') {
                // tidak difilter
            }

            // Role lain
            else {
                // tidak difilter
            }
        } 
        
        // Guest
        else {
            $query->whereNull('kelas_akademik');
        }

        // Filter sub-kategori
        if ($kategori) {
            $query->where('kategori', $kategori);
        }

        // Ambil semua sub kategori unik untuk sidebar
        $daftarKategori = Buku::where('tipe_bacaan', $tipe)
            ->select('kategori')
            ->distinct()
            ->pluck('kategori');

        $buku = $query->orderBy('judul')->get();

        return view('user.referensi.kategori.index', [
            'buku'            => $buku,
            'tipe'            => $tipe,
            'kategoriDipilih' => $kategori,
            'daftarKategori'  => $daftarKategori,
        ]);
    }
}
