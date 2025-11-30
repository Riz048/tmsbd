<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    protected $table = 'user';

    protected $primaryKey = 'id_user';

    public $timestamps = false;

    protected $fillable = [
        'nama',
        'username',
        'password',
        'role',
        'kelamin',
        'tempat_lahir',
        'tanggal_lahir',
        'telpon',
        'alamat',
        'foto'
    ];

    protected $casts = [
        'tanggal_lahir' => 'date'
    ];

    // Relasi User -> Peminjaman
    public function peminjaman()
    {
        return $this->hasMany(Peminjaman::class, 'id_user');
    }
}
