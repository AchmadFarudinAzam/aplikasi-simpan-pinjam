<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use Notifiable;

    protected $table = 'm_pelanggan';
    public $timestamps = false;

    protected $fillable = [
        'kd',
        'kode',
        'nama',
        'jabatan',
        'telp',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function tabungan()
{
    return $this->hasMany(Tabungan::class, 'pelanggan_kd', 'kd');
}

public function pinjaman()
{
    return $this->hasMany(\App\Models\Pinjaman::class, 'pelanggan_kd', 'kd');
}
}