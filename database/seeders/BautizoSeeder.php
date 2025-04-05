<?php

namespace Database\Seeders;

use App\Models\Bautizo;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BautizoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Bautizo::factory()->count(100)->create();
    }
}
