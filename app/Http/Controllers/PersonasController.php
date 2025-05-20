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

        $personas = $query->limit(10)->get();

        return response()->json(['data' => $personas]);
    }

    public function index(Request $request)
    {
        $query = Persona::query();

        if ($request->has('tipo_persona') && $request->tipo_persona != '') {
            $query->where('tipo_persona', $request->tipo_persona);
        }

        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nombres', 'like', '%' . $request->search . '%')
                  ->orWhere('apellidos', 'like', '%' . $request->search . '%')
                  ->orWhere('dpi_cui', 'like', '%' . $request->search . '%');
            });
        }

        $personas = $query->paginate(10);
        return view('personas.index', compact('personas'));
    }

    public function create()
    {
        $departamentos = Departamento::all();
        $municipios = old('departamento_id')
            ? Municipio::where('departamento_id', old('departamento_id'))->get()
            : collect();

        return view('personas.create', compact('departamentos', 'municipios'));
    }

    public function show($persona_id)
    {
        $persona = Persona::with(['municipio', 'padre', 'madre', 'padrino', 'madrina'])->findOrFail($persona_id);
        return view('personas.show', compact('persona'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'dpi_cui' => 'required|digits:13|numeric|unique:personas,dpi_cui',
            'nombres' => 'required|regex:/^[\pL\s]+$/u|max:50',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u|max:50',
            'municipio_id' => 'required|integer|exists:municipio,municipio_id',
            'direccion' => 'required|string|min:6|max:255',
            'fecha_nacimiento' => 'required|date_format:Y-m-d',
            'sexo' => 'required|in:M,F',
            'num_telefono' => 'nullable|digits_between:8,15|numeric',
            'tipo_persona' => 'required|in:F,S,O',
        ]);

        Persona::create($request->all());

        return redirect()->route('personas.index')->with('success', 'Persona creada exitosamente.');
    }

    public function edit($persona_id)
    {
        $persona = Persona::with('municipio')->findOrFail($persona_id);
        $departamento_id = $persona->municipio->departamento_id ?? null;

        $departamentos = Departamento::all();
        $municipios = $departamento_id
            ? Municipio::where('departamento_id', $departamento_id)->get()
            : collect();

        return view('personas.edit', compact('persona', 'departamentos', 'municipios'));
    }

    public function update(Request $request, $persona_id)
    {
        $request->validate([
            'dpi_cui' => 'required|digits:13|numeric|unique:personas,dpi_cui,' . $persona_id . ',persona_id',
            'nombres' => 'required|regex:/^[\pL\s]+$/u|max:50',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u|max:50',
            'direccion' => 'required|string|min:6|max:255',
            'fecha_nacimiento' => 'required|date_format:Y-m-d',
            'sexo' => 'required|in:M,F',
            'num_telefono' => 'nullable|digits_between:8,15|numeric',
            'tipo_persona' => 'required|in:F,S,O',
            'municipio_id' => 'required|integer|exists:municipio,municipio_id',
        ], [
            'municipio_id.required' => 'Debe seleccionar un municipio.',
            'municipio_id.integer' => 'El municipio no es válido.',
            'municipio_id.exists' => 'El municipio seleccionado no existe.',
        ]);

        $persona = Persona::findOrFail($persona_id);
        $persona->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'dpi_cui' => $request->dpi_cui,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'direccion' => $request->direccion,
            'sexo' => $request->sexo,
            'num_telefono' => $request->num_telefono,
            'tipo_persona' => $request->tipo_persona,
            'municipio_id' => $request->municipio_id,
        ]);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada exitosamente.');
    }

    public function showJson($id)
    {
        $persona = Persona::findOrFail($id);

        return response()->json([
            'persona_id' => $persona->persona_id,
            'nombres' => $persona->nombres,
            'apellidos' => $persona->apellidos,
            'dpi_cui' => $persona->dpi_cui,
        ]);
    }
}
