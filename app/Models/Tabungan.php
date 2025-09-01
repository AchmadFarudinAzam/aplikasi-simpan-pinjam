<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tabungan extends Model
{
    protected $table = 'pelanggan_tabungan';
    public $timestamps = false;

    protected $fillable = [
        'kd',
        'pelanggan_kd',
        'pelanggan_kd',
        'pelanggan_kode',
        'pelanggan_nama',
        'pelanggan_jabatan',
        'pelanggan_telp',
        'tgl',
        'debet',
        'nilai',
        'saldo',
        'postdate',
    ];
}