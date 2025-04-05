<?php

namespace Database\Seeders;

use App\Models\Departamento;
use Illuminate\Database\Seeder;

class deptos extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $departamentos = [
            'Guatemala',
            'El Progreso',
            'Sacatepéquez',
            'Chimaltenango',
            'Escuintla',
            'Santa Rosa',
            'Sololá',
            'Totonicapán',
            'Quetzaltenango',
            'Suchitepéquez',
            'Retalhuleu',
            'San Marcos',
            'Huehuetenango',
            'Quiché',
            'Baja Verapaz',
            'Alta Verapaz',
            'Petén',
            'Izabal',
            'Zacapa',
            'Chiquimula',
            'Jalapa',
            'Jutiapa',
        ];

        foreach ($departamentos as $depto) {
            Departamento::create([
                'depto' => $depto,
            ]);
        }
    }
}
