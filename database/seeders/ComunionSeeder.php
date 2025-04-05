<?php

namespace Database\Seeders;

use App\Models\Comunion;
use Database\Factories\ComunionFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
class ComunionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear 100 comuniones aleatorias
         // Crear varias instancias de Comunion
         Comunion::factory()->count(100)->create();
    }
}
