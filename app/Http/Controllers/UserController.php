<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Riwayat transaksi
    public function riwayat()
    {
        // Ambil ID user dari login manual
        $userId = session('user_id');

        // Kalau user tidak login → redirect
        if (!$userId) {
            return redirect('/login');
        }

        // Ambil semua peminjaman milik user
        $riwayat = \App\Models\Peminjaman::with(['detail.buku', 'pengembalian'])
            ->where('id_user', $userId)
            ->orderBy('tanggal_pinjam', 'desc')
            ->get();

        return view('user.transaksi.riwayat', compact('riwayat'));
    }
}
