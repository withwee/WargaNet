<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User default
        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        User::factory()->create([
            'name' => 'Cipengs',
            'email' => 'cipengs@example.com',
            'password' => bcrypt('password'), 
            'no_kk' => '1234567890123456',     
        ]);

        $this->call(IuranSeeder::class);
    }
}
