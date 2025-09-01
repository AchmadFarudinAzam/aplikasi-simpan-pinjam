<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;

class Nasabah extends Authenticatable
{
    protected $table = 'm_pelanggan'; // Tabel khusus nasabah
    protected $primaryKey = 'kd';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = ['kd', 'kode', 'nama', 'jabatan', 'telp', 'password'];
}