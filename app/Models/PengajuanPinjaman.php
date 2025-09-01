<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PengajuanPinjaman extends Model
{
    protected $table = 'pengajuan_pinjaman';
    protected $primaryKey = 'kd';
    public $incrementing = false;
    public $timestamps = false;

    protected $fillable = [
        'kd',
        'id_user',
        'jenis_pinjaman',
        'peruntukan',
        'nominal',
        'jangka_waktu',
        'satuan_waktu',
        'jatuh_tempo_tanggal',
        'biaya_jasa',
        'biaya_provisi',
        'biaya_lain',
        'total_diterima',
        'status',
        'postdate'
    ];
}
