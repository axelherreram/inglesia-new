<?php

namespace Database\Seeders;

use App\Models\DatoGeneralParroquia;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class InfoIglesia extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DatoGeneralParroquia::create([
            'nombre_parroquia' => 'Parroquia Nuestra Señora de las Mercedes',
            'direccion' => 'Calle al Calvario, Barrio el Centro, Sansare, El Progreso',
            'num_telefono' => '1234567890',
        ]);
    }
}
