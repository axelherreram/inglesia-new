<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunion;
use App\Models\Municipio;
use App\Models\Departamento;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class ComunionController extends Controller
{
    // Método para mostrar la lista de comuniones con búsqueda
    public function index(Request $request)
    {
        // Recibir los valores del formulario de búsqueda
        $search = $request->input('search');
        $year = $request->input('year');

        // Construir la consulta para buscar por nombre, apellido o año de la comunión
        $comuniones = Comunion::query()
            ->when($search, function ($query, $search) {
                return $query->where('nombre_persona_participe', 'like', '%' . $search . '%');
            })
            ->when($year, function ($query, $year) {
                return $query->whereYear('fecha_comunion', $year);
            })
            ->paginate(10);
        
        // Verificar si no se encontraron resultados
        if ($comuniones->isEmpty()) {
            session()->flash('no_results', 'No se encontraron registros de comuniones con los datos especificados.');
        } else {
            session()->forget('no_results');
        } 
        
        return view('list-comunion', compact('comuniones', 'search', 'year'));
    }

    /**
     * Muestra el formulario para crear una nueva comunión.
     */
    public function create(Request $request) 
    {
        $departamentos = Departamento::all();
        $departamento_id = old('departamento_id'); 
        $municipios = collect(); 
    
        // Si hay un departamento seleccionado, cargar sus municipios
        if ($departamento_id) {
            $municipios = Municipio::where('departamento_id', $departamento_id)->get();
        }
    
        return view('comunion-craete-update', compact('departamentos', 'municipios'));
    }
    
    // Mostrar los detalles de una comunión
    public function show($comunion_id)
    {
        $comunion = Comunion::findOrFail($comunion_id);
        $departamentos = Departamento::all();
        return view('comunion.comunion-show', compact('comunion', 'departamentos'));
    }
    public function update(Request $request, $comunion_id)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_comunion' => 'required|date',
            'nombre_persona_participe' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'nombre_padre' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
        ], [
            'NoPartida.required' => 'El número de partida es obligatorio.',
            'folio.required' => 'El folio es obligatorio.',
            'fecha_comunion.required' => 'La fecha de la comunión es obligatoria.',
            'nombre_persona_participe.required' => 'El nombre de la persona es obligatorio.',
            'municipio_id.required' => 'El municipio es obligatorio.',
            'departamento_id.required' => 'El departamento es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser mayor que la fecha actual.',
        ]);

        // Buscar la comunión y actualizarla
        $comunion = Comunion::findOrFail($comunion_id);
        $comunion->update($validatedData);

        // Redirigir al listado de comuniones con un mensaje de éxito
        return redirect()->route('comuniones.index')->with('success', 'Primera Comunión actualizada exitosamente.');
    }

    /**
     * Almacena un nuevo registro de comunión en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario con mensajes personalizados
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_comunion' => 'required|date',
            'nombre_persona_participe' => 'required|string|max:255',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'nombre_padre' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
        ], [
            'NoPartida.required' => 'El número de partida es obligatorio.',
            'folio.required' => 'El folio es obligatorio.',
            'fecha_comunion.required' => 'La fecha de la comunión es obligatoria.',
            'nombre_persona_participe.required' => 'El nombre de la persona es obligatorio.',
            'municipio_id.required' => 'El municipio es obligatorio.',
            'departamento_id.required' => 'El departamento es obligatorio.',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser mayor que la fecha actual.',
        ]);

        // Crear un nuevo registro en la tabla 'comunion'
        Comunion::create([
            'NoPartida' => $validatedData['NoPartida'],
            'folio' => $validatedData['folio'],
            'fecha_comunion' => $validatedData['fecha_comunion'],
            'nombre_persona_participe' => $validatedData['nombre_persona_participe'],
            'fecha_nacimiento' => $validatedData['fecha_nacimiento'],
            'municipio_id' => $validatedData['municipio_id'],
            'departamento_id' => $validatedData['departamento_id'],
            'nombre_padre' => $validatedData['nombre_padre'],
            'nombre_madre' => $validatedData['nombre_madre'],
        ]);

        // Redirigir al usuario a la lista de comuniones con un mensaje de éxito
        return redirect()->route('comuniones.index')->with('success', 'Primera comunión guardada exitosamente.');
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

    public function generatePDF($comunion_id)
    {
        $comunion = Comunion::findOrFail($comunion_id);

        // Cargar la vista del PDF y pasar los datos
        $pdf = PDF::loadView('pdf.comunion', compact('comunion'));

        return $pdf->stream('constancia-comunion.pdf');
    }
}
