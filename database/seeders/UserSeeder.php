<?php

namespace Database\Seeders;  
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name'     => 'dummyUsers',
            'email'    => 'dummy@gmail.com',
            'password' => Hash::make('password123'),
            'nik'      => '1234567890123457',
            'no_kk'    => '1234567890123456',
            'phone'    => '08123456789',
            'jumlah_keluarga' => 1,
            'role' => 'user'
        ]);
    }
}

