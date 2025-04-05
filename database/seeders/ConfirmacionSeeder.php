<?php

namespace Database\Seeders;

use App\Models\Confirmacion;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ConfirmacionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 50 confirmaciones de ejemplo
        Confirmacion::factory()->count(100)->create();
    }
}
