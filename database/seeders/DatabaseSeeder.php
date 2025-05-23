<?php

namespace Database\Seeders;

use App\Models\PeminjamanRuangan;
use App\Models\Ruangan;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory(20)->create();
        Ruangan::factory(15)->create();
        // PeminjamanRuangan::factory(40)->create();
    }
}
