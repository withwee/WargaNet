<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class IuranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('iurans')->insert([
            [
                'jenis_iuran' => 'Iuran Sampah',
                'tgl_bayar' => null,
                'total_bayar' => 125000,
                'no_kk' => '1234567890123456',
                'status' => 'Belum Bayar',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'jenis_iuran' => 'Iuran Keamanan',
                'tgl_bayar' => Carbon::now(),
                'total_bayar' => 25000,
                'no_kk' => '1234567890123456',
                'status' => 'Sudah Bayar',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
            [
                'jenis_iuran' => 'Iuran Acara 17 Agustus',
                'tgl_bayar' => Carbon::now(),
                'total_bayar' => 55000,
                'no_kk' => '1234567890123456',
                'status' => 'Sudah Bayar',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now()
            ],
        ]);
    }
}
