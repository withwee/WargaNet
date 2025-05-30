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
            'name'     => 'SuperAdmin',
            'email'    => 'admin@example.com',
            'password' => Hash::make('admin123'),
            'nik'      => '1234567890123458', // Tambahkan nilai untuk nik
            'no_kk'    => '1234567890123458',
            'phone'    => '08123456789',
            'jumlah_LK' => 0,
            'jumlah_PR' => 0,
            'role'     => 'admin',
        ]);
    }
}

