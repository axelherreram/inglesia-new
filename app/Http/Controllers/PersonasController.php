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

    // Mostrar todos los registros de personas
    public function index(Request $request)
    {
        $query = Persona::query();

        // Filtrar por tipo de persona si se selecciona uno
        if ($request->has('tipo_persona') && $request->tipo_persona != '') {
            $query->where('tipo_persona', $request->tipo_persona);
        }

        // Filtro de búsqueda por nombre, apellido o DPI
        if ($request->has('search') && $request->search != '') {
            $query->where(function ($q) use ($request) {
                $q->where('nombres', 'like', '%' . $request->search . '%')
                    ->orWhere('apellidos', 'like', '%' . $request->search . '%')
                    ->orWhere('dpi_cui', 'like', '%' . $request->search . '%');
            });
        }

        // Obtener las personas filtradas
        $personas = $query->paginate(10);

        return view('personas.index', compact('personas'));
    }



    public function create()
    {
        $departamentos = Departamento::all();

        $municipios = collect();
        if (old('departamento_id')) {
            $municipios = Municipio::where('departamento_id', old('departamento_id'))->get();
        }

        // Pasamos los departamentos y municipios a la vista
        return view('personas.create', compact('departamentos', 'municipios'));
    }


    // Mostrar una persona específica
    public function show($persona_id)
    {
        $persona = Persona::with(['municipio', 'padre', 'madre', 'padrino', 'madrina'])->findOrFail($persona_id);
        return view('personas.show', compact('persona'));
    }
    // Almacenar una nueva persona
    public function store(Request $request)
    {
        $request->validate([
            'dpi_cui' => 'required|digits:13|numeric|unique:personas,dpi_cui',
            'nombres' => 'required|regex:/^[\pL\s]+$/u|max:50',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u|max:50',
            'municipio_id' => 'required|integer',
            'direccion' => 'required|string|min:6|max:255',
            'fecha_nacimiento' => 'required|date_format:Y-m-d',
            'sexo' => 'required|in:M,F',
            'num_telefono' => 'nullable|digits_between:8,15|numeric',
            'tipo_persona' => 'required|in:F,S,O',
        ], [
            'dpi_cui.required' => 'El DPI es obligatorio.',
            'dpi_cui.digits' => 'El DPI debe tener exactamente 13 dígitos.',
            'dpi_cui.numeric' => 'El DPI solo debe contener números.',
            'dpi_cui.unique' => 'Este DPI/CUI ya está registrado.',
            'nombres.required' => 'El nombre es obligatorio.',
            'nombres.regex' => 'El nombre solo debe contener letras y espacios.',
            'nombres.max' => 'El nombre no debe superar los 50 caracteres.',

            'apellidos.required' => 'El apellido es obligatorio.',
            'apellidos.regex' => 'El apellido solo debe contener letras y espacios.',
            'apellidos.max' => 'El apellido no debe superar los 50 caracteres.',

            'municipio_id.required' => 'Debe seleccionar un municipio.',
            'municipio_id.integer' => 'El municipio seleccionado no es válido.',

            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.min' => 'La dirección debe tener al menos 6 caracteres.',
            'direccion.max' => 'La dirección no debe superar los 255 caracteres.',

            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date_format' => 'La fecha de nacimiento debe tener el formato YYYY-MM-DD.',

            'sexo.required' => 'Debe seleccionar un sexo.',
            'sexo.in' => 'El sexo debe ser "M" para masculino o "F" para femenino.',

            'num_telefono.digits_between' => 'El número de teléfono debe tener entre 8 y 15 dígitos.',
            'num_telefono.numeric' => 'El número de teléfono solo debe contener números.',

            'tipo_persona.required' => 'Debe seleccionar un tipo de persona.',
            'tipo_persona.in' => 'El tipo de persona debe ser "F" (feligrés), "S" (sacerdote) u "O" (obispo).',
        ]);

        Persona::create($request->all());

        return redirect()->route('personas.index')->with('success', 'Persona creada exitosamente.');
    }
    public function edit($persona_id)
    {
        // Recuperamos la persona por su ID
        $persona = Persona::with('municipio')->findOrFail($persona_id);

        // Pasamos los datos a la vista
        return view('personas.edit', compact('persona'));
    }

    // Actualizar una persona
// Actualizar una persona
    public function update(Request $request, $persona_id)
    {
        logger($request->all());
        $request->validate([
            'dpi_cui' => 'required|digits:13|numeric|unique:personas,dpi_cui,' . $persona_id . ',persona_id',
            'nombres' => 'required|regex:/^[\pL\s]+$/u|max:50',
            'apellidos' => 'required|regex:/^[\pL\s]+$/u|max:50',
            'direccion' => 'required|string|min:6|max:255',
            'fecha_nacimiento' => 'required|date_format:Y-m-d',
            'sexo' => 'required|in:M,F',
            'num_telefono' => 'nullable|digits_between:8,15|numeric',
            'tipo_persona' => 'required|in:F,S,O',
        ], [
            'dpi_cui.required' => 'El DPI es obligatorio.',
            'dpi_cui.digits' => 'El DPI debe tener exactamente 13 dígitos.',
            'dpi_cui.numeric' => 'El DPI solo debe contener números.',
            'dpi_cui.unique' => 'Este DPI ya está registrado.',
            'nombres.required' => 'El nombre es obligatorio.',
            'nombres.regex' => 'El nombre solo debe contener letras y espacios.',
            'nombres.max' => 'El nombre no debe superar los 50 caracteres.',
            'apellidos.required' => 'El apellido es obligatorio.',
            'apellidos.regex' => 'El apellido solo debe contener letras y espacios.',
            'apellidos.max' => 'El apellido no debe superar los 50 caracteres.',
            'direccion.required' => 'La dirección es obligatoria.',
            'direccion.min' => 'La dirección debe tener al menos 6 caracteres.',
            'direccion.max' => 'La dirección no debe superar los 255 caracteres.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date_format' => 'La fecha de nacimiento debe tener el formato YYYY-MM-DD.',
            'sexo.required' => 'Debe seleccionar un sexo.',
            'sexo.in' => 'El sexo debe ser "M" para masculino o "F" para femenino.',
            'num_telefono.digits_between' => 'El número de teléfono debe tener entre 8 y 15 dígitos.',
            'num_telefono.numeric' => 'El número de teléfono solo debe contener números.',
            'tipo_persona.required' => 'Debe seleccionar un tipo de persona.',
            'tipo_persona.in' => 'El tipo de persona debe ser "F" (feligrés), "S" (sacerdote) u "O" (obispo).',
        ]);

        $persona = Persona::findOrFail($persona_id);
        logger($persona);
        $persona->update([
            'nombres' => $request->nombres,
            'apellidos' => $request->apellidos,
            'dpi_cui' => $request->dpi_cui,
            'fecha_nacimiento' => $request->fecha_nacimiento,
            'direccion' => $request->direccion,
            'sexo' => $request->sexo,
            'num_telefono' => $request->num_telefono,
            'tipo_persona' => $request->tipo_persona,
        ]);

        return redirect()->route('personas.index')->with('success', 'Persona actualizada exitosamente.');
    }


}
