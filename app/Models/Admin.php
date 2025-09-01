<?php

namespace App\Models;

//use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Model
{
    protected $table = 'adminx'; // Tabel khusus admin
    protected $primaryKey = 'kd';
    public $timestamps = false;

    protected $fillable = ['kd', 'usernamex', 'passwordx', 'postdate'];
}