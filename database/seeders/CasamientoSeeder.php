<?php

namespace Database\Seeders;

use App\Models\Casamiento;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CasamientoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Casamiento::factory()->count(100)->create();
    }
}
