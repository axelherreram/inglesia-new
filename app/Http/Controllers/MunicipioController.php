<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function getMunicipios($departamento_id)
    {
        // Recuperar los municipios del departamento seleccionado
        $municipios = Municipio::where('departamento_id', $departamento_id)->get();

        // Retornar los municipios en formato JSON
        return response()->json($municipios);
    }
}
