<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Persona;

class PersonasController extends Controller
{
    public function buscarPersonas(Request $request)
    {
        $search = $request->input('search');
        $tipo = $request->input('tipo');
        $sexo = $request->input('sexo');
        $query = Persona::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nombres', 'like', '%' . $search . '%')
                    ->orWhere('apellidos', 'like', '%' . $search . '%')
                    ->orWhere('dpi_cui', 'like', '%' . $search . '%');
            });
        }

        if ($tipo) {
            $query->where('tipo_persona', $tipo);
        }

        if ($sexo) {
            $query->where('sexo', $sexo);
        }

        $personas = $query->limit(10)->get(['persona_id', 'nombres', 'apellidos', 'dpi_cui']);

        return response()->json(['data' => $personas]);
    }
}
