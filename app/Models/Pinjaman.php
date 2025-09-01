<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pinjaman extends Model
{
    protected $table = 'm_pinjam';
    public $timestamps = false;

    protected $fillable = [
        'kd',
        'pelanggan_kd',
        'tanggal',
        'nominal',
        'lama_angsuran',
        'angsuran_ke',
        'keterangan',
    ];
}