<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Peminjaman extends Model
{
    protected $table = 'peminjaman';
    protected $primaryKey = 'id';
    public $timestamps = false;

    protected $fillable = [
        'tanggal_pinjam',
        'lama_pinjam',
        'keterangan',
        'status',
        'id_user',
        'id_pegawai',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function detail()
    {
        return $this->hasMany(PeminjamanDetail::class, 'peminjaman_id');
    }
}
