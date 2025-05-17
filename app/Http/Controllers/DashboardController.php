<?php

namespace App\Http\Controllers;

use App\Models\Bautizo;
use App\Models\Comunion;
use App\Models\Confirmacion;
use App\Models\Casamiento;
use App\Models\Persona; // Asegúrate de importar el modelo Persona
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        // Contar los eventos
        $totalBautizos = Bautizo::count();
        $totalComuniones = Comunion::count();
        $totalConfirmaciones = Confirmacion::count();
        $totalCasamientos = Casamiento::count();

        // Obtener la distribución por sexo (masculino y femenino)
        $totalHombres = Persona::where('sexo', 'M')->count(); // 'M' para masculino
        $totalMujeres = Persona::where('sexo', 'F')->count(); // 'F' para femenino

        // Obtener la distribución por tipo de persona (Feligrés, Sacerdote, Obispo)
        $totalFeligreses = Persona::where('tipo_persona', 'F')->count();
        $totalSacerdotes = Persona::where('tipo_persona', 'S')->count();
        $totalObispos = Persona::where('tipo_persona', 'O')->count();

        // Pasar los datos a la vista
        return view('dashboard', compact(
            'totalBautizos',
            'totalComuniones',
            'totalConfirmaciones',
            'totalCasamientos',
            'totalHombres',
            'totalMujeres',
            'totalFeligreses',
            'totalSacerdotes',
            'totalObispos'
        ));
    }
}
