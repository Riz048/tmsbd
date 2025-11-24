<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Buku extends Model
{
    protected $table = 'buku';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'kelas_akademik',
        'tipe_bacaan',
        'kode_buku',
        'judul',
        'nama_penerbit',
        'isbn',
        'pengarang',
        'jlh_hal',
        'jlh_buku',
        'status_buku',
        'tahun_terbit',
        'sinopsis',
        'gambar',
    ];
}
