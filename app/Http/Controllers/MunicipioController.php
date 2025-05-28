<?php

namespace App\Http\Controllers;

use App\Models\Municipio;
use Illuminate\Http\Request;

class MunicipioController extends Controller
{
    public function getMunicipios($departamento_id)
    {
        return response()->json(Municipio::where('departamento_id', $departamento_id)->get());
    }
}