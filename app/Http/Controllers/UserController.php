<?php

namespace App\Http\Controllers;

use App\Models\Peminjaman;
use Illuminate\Http\Request;

class UserController extends Controller
{
    // Riwayat transaksi
    public function riwayat()
    {
        $userId = auth()->id();

        $riwayat = Peminjaman::where('id_user', $userId)
            ->with(['detail.buku'])
            ->orderBy('tanggal_pinjam', 'desc')
            ->get();

        return view('user.transaksi.riwayat', compact('riwayat'));
    }
}
