<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use Illuminate\Http\Request;
use App\Models\Municipio;
use App\Models\Departamento;


class PersonasController extends Controller
{

    public function buscarPersonas(Request $request)
    {
        $search = $request->input('search');
        $tipo = $request->input('tipo'); // Nuevo parámetro para el tipo de persona
        $sexo = $request->input('sexo');
        $query = Persona::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombres', 'like', '%' . $search . '%')
                    ->orWhere('apellidos', 'like', '%' . $search . '%')
                    ->orWhere('dpi_cui', 'like', '%' . $search . '%');
            });
        }

        // Filtrar por tipo de persona si se proporciona
        if ($tipo) {
            $query->where('tipo_persona', $tipo);
        }
        // Filtrar por sexo
        if ($sexo) {
            $query->where('sexo', $sexo);
        }

        $personas = $query->limit(10)->get();

        return response()->json([
            'data' => $personas
        ]);
    }

}
