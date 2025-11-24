<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class ReferensiController extends Controller
{
    public function home(Request $request)
    {
        // Search
        $keyword = $request->input('q');

        if ($keyword) {
            $bukuHasil = Buku::where(function ($q) use ($keyword) {
                    $q->where('judul', 'like', "%{$keyword}%")
                      ->orWhere('pengarang', 'like', "%{$keyword}%")
                      ->orWhere('kode_buku', 'like', "%{$keyword}%");
                })
                ->orderBy('judul')
                ->get();

            return view('user.referensi.home', [
                'keyword'     => $keyword,
                'bukuHasil'   => $bukuHasil,
                'bukuTerbaru' => collect(),
            ]);
        }

        // Koleksi terbaru
        $bukuTerbaru = Buku::orderBy('id', 'desc')->limit(12)->get();

        return view('user.referensi.home', [
            'keyword'     => null,
            'bukuHasil'   => null,
            'bukuTerbaru' => $bukuTerbaru,
        ]);
    }

    // List berdasarkan kategori
    public function kategori($kategori)
    {
        switch ($kategori) {
            case 'kelas10':
                $judul = "Buku Akademik Kelas 10";
                $buku  = Buku::where('kelas_akademik', '10')->get();
                break;

            case 'kelas11':
                $judul = "Buku Akademik Kelas 11";
                $buku  = Buku::where('kelas_akademik', '11')->get();
                break;

            case 'kelas12':
                $judul = "Buku Akademik Kelas 12";
                $buku  = Buku::where('kelas_akademik', '12')->get();
                break;

            case 'bacaan':
                $judul = "Buku Bacaan";
                $buku  = Buku::where('kelas_akademik', 'non-akademik')->get();
                break;

            default:
                abort(404);
        }

        return view('user.referensi.kategori.list', compact('judul', 'buku'));
    }
}
