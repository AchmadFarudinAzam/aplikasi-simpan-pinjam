<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    public function run()
    {
        DB::table('adminx')->insert([
            'kd' => uniqid(),
            'usernamex' => 'admin',
            'passwordx' => md5('admin'),
            'postdate' => now(),
        ]);
    }
}