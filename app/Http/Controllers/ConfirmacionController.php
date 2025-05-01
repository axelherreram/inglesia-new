<?php

namespace App\Http\Controllers;

use App\Models\Confirmacion;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ConfirmacionController extends Controller
{
    /**
     * Muestra una lista de confirmaciones con paginación.
     */
    public function index(Request $request)
    {
        $search = $request->input('nombre');
        $year = $request->input('fecha_confirmacion');

        // Filtra por nombre y año si se proporcionan parámetros de búsqueda
        $confirmaciones = Confirmacion::query()
            ->when($search, function ($query, $search) {
                return $query->where('nombre_persona_confirmada', 'like', "%{$search}%");
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('fecha_confirmacion', $year);
            })
            ->paginate(10);

        // Verifica si no se encontraron resultados y añade mensaje a la sesión
        if ($confirmaciones->isEmpty()) {
            session()->flash('no_results', 'No se encontraron registros de confirmaciones con los datos especificados.');
        } else {
            session()->forget('no_results');
        }
        return view('list-confirmacion', compact('confirmaciones'));
    }

     /**
     * Muestra el formulario para crear una nueva confirmación.
     */
    public function create(Request $request)
    {
        $departamentos = Departamento::all();
        $departamento_id = old('departamento_id');
        $municipios = collect();

        // Cargar municipios si ya se seleccionó un departamento
        if ($departamento_id) {
            $municipios = Municipio::where('departamento_id', $departamento_id)->get();
        }

        return view('confirmaciones.create', compact('departamentos', 'municipios'));
    }

     /**
     * Almacena una nueva confirmación en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'persona_confirmada_id' => 'required|exists:personas,persona_id',
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_confirmacion' => 'required|date|before_or_equal:today',
            'nombre_parroquia_bautizo' => 'required|string|max:255',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'sacerdote_id' => 'required|exists:personas,persona_id',
            'padre_id' => 'nullable|exists:personas,persona_id',
            'madre_id' => 'nullable|exists:personas,persona_id',
            'padrino_id' => 'nullable|exists:personas,persona_id',
            'madrina_id' => 'nullable|exists:personas,persona_id',
        ], [
            'persona_confirmada_id.required' => 'El campo persona confirmada es obligatorio.',
            'persona_confirmada_id.exists' => 'La persona confirmada no existe.',
            'NoPartida.required' => 'El campo número de partida es obligatorio.',
            'NoPartida.string' => 'El número de partida debe ser una cadena de texto.',
            'NoPartida.max' => 'El número de partida no puede exceder los 20 caracteres.',
            'folio.required' => 'El campo folio es obligatorio.',
            'folio.string' => 'El folio debe ser una cadena de texto.',
            'folio.max' => 'El folio no puede exceder los 50 caracteres.',
            'fecha_confirmacion.required' => 'La fecha de confirmación es obligatoria.',
            'fecha_confirmacion.date' => 'La fecha de confirmación debe ser una fecha válida.',
            'fecha_confirmacion.before_or_equal' => 'La fecha de confirmación no puede ser mayor a la fecha actual.',
            'nombre_parroquia_bautizo.required' => 'El campo nombre de la parroquia de bautizo es obligatorio.',
            'nombre_parroquia_bautizo.string' => 'El nombre de la parroquia de bautizo debe ser una cadena de texto.',
            'nombre_parroquia_bautizo.max' => 'El nombre de la parroquia de bautizo no puede exceder los 255 caracteres.',
            'municipio_id.required' => 'El municipio es obligatorio.',
            'municipio_id.exists' => 'El municipio seleccionado no existe.',
            'departamento_id.required' => 'El departamento es obligatorio.',
            'departamento_id.exists' => 'El departamento seleccionado no existe.',
            'sacerdote_id.required' => 'El sacerdote es obligatorio.',
            'sacerdote_id.exists' => 'El sacerdote no existe.',
            'padre_id.exists' => 'El padre no existe.',
            'madre_id.exists' => 'La madre no existe.',
            'padrino_id.exists' => 'El padrino no existe.',
            'madrina_id.exists' => 'La madrina no existe.',
        ]);


        // Validación personalizada para evitar que una misma persona ocupe varios roles
        $personaIds = [
            $request->persona_confirmada_id,
            $request->sacerdote_id,
            $request->padre_id,
            $request->madre_id,
            $request->padrino_id,
            $request->madrina_id,
        ];

        $personaIds = array_filter($personaIds, function ($value) {
            return !is_null($value);
        });

        if (count($personaIds) !== count(array_unique($personaIds))) {
            return redirect()->back()->withErrors([
                'persona_confirmada_id' => 'La misma persona no puede ocupar varios roles en la confirmación.',
            ]);
        }

        Confirmacion::create($validatedData);

        return redirect()->route('confirmaciones.index')->with('success', 'Confirmación guardada exitosamente.');
    }

    /**
     * Obtiene los municipios basados en el departamento seleccionado.
     */
    public function getMunicipios($departamento_id)
    {
        // Obtener los municipios relacionados con el departamento
        $municipios = Municipio::where('departamento_id', $departamento_id)->get();

        // Devolver los municipios como respuesta JSON
        return response()->json($municipios);
    }

    
    // Método para mostrar el detalle de una confirmación
    public function show($confirmacion_id)
    {
        // Buscar la confirmación por su ID
        $confirmacion = Confirmacion::findOrFail($confirmacion_id);
        // Obtener todos los departamentos para el selector
        $departamentos = Departamento::all();
        // Retornar la vista con los detalles de la confirmación
        return view('confirmacion.confirmacion-show', compact('confirmacion', 'departamentos'));
    }

    /**
     * Actualiza un registro existente de confirmación en la base de datos.
     */
    public function update(Request $request, $confirmacion_id)
    {
        // Validar los datos del formulario con las mismas reglas que el store
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_confirmacion' => 'required|date',
            'nombre_persona_confirmo' => 'required|string|max:255',
            'nombre_persona_confirmada' => 'required|string|max:255',
            'edad' => 'required|string|max:4',
            'nombre_parroquia_bautizo' => 'required|string|max:255',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'nombre_padre' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'nombre_persona_padrino' => 'nullable|string|max:255',
            'nombre_persona_madrina' => 'nullable|string|max:255',
        ], [
            'NoPartida.required' => 'El número de partida es obligatorio.',
            'folio.required' => 'El folio es obligatorio.',
            'fecha_confirmacion.required' => 'La fecha de la confirmación es obligatoria.',
            'nombre_persona_confirmada.required' => 'El nombre de la persona confirmada es obligatorio.',
            'edad.required' => 'La edad es obligatoria.',
            'municipio_id.required' => 'El municipio es obligatorio.',
            'departamento_id.required' => 'El departamento es obligatorio.',
        ]);

        // Buscar la confirmación por ID
        $confirmacion = Confirmacion::findOrFail($confirmacion_id);

        // Actualizar los datos de la confirmación con los valores validados
        $confirmacion->update($validatedData);

        // Redirigir al listado de confirmaciones con un mensaje de éxito
        return redirect()->route('confirmaciones.index')->with('success', 'Confirmación actualizada exitosamente.');
    }

    public function generatePDF($confirmacion_id)
    {
        $confirmacion = Confirmacion::findOrFail($confirmacion_id);

        // Cargar la vista del PDF y pasar los datos
        $pdf = PDF::loadView('pdf.confirmacion', compact('confirmacion'));

        return $pdf->stream('constancia-confirmacion.pdf');
    }
}
