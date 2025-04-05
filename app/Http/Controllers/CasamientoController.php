<?php

namespace App\Http\Controllers;

use App\Models\Casamiento;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class CasamientoController extends Controller
{
    /**
     * Muestra una lista de casamientos con paginación.
     */
    public function index(Request $request)
    {
        $nombreEsposo = $request->input('nombre_esposo');
        $nombreEsposa = $request->input('nombre_esposa');
        $anio = $request->input('anio');

        // Filtrar por nombre del esposo, esposa y año si se proporcionan parámetros
        $casamientos = Casamiento::query()
            ->when($nombreEsposo, function ($query, $nombreEsposo) {
                return $query->where('nombre_esposo', 'like', "%{$nombreEsposo}%");
            })
            ->when($nombreEsposa, function ($query, $nombreEsposa) {
                return $query->where('nombre_esposa', 'like', "%{$nombreEsposa}%");
            })
            ->when($anio, function ($query, $anio) {
                return $query->whereYear('fecha_casamiento', $anio);
            })
            ->paginate(10);
        // Verifica si no se encontraron resultados y añade mensaje a la sesión
        if ($casamientos->isEmpty()) {
            session()->flash('no_results', 'No se encontraron registros de casamientos con los datos especificados.');
        } else {
            session()->forget('no_results');
        }
        return view('list-casamiento', compact('casamientos'));
    }
    /**
     * Muestra el formulario para crear un nuevo casamiento.
     */
    public function create()
    {
        return view('casamiento-craete-update');
    }

    /**
     * Almacena un nuevo registro de casamiento en la base de datos.
     */ public function store(Request $request)
    {
        // Crear un nuevo casamiento en la base de datos
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_casamiento' => 'required|date',
            'nombres_testigos' => 'required|string',
            'nombre_esposo' => 'required|string|max:255',
            'edad_esposo' => 'required|string|max:4',
            'origen_esposo' => 'required|string|max:255',
            'feligresesposo' => 'nullable|string|max:255',
            'nombre_padre_esposo' => 'required|string|max:255',
            'nombre_madre_esposo' => 'required|string|max:255',
            'nombre_esposa' => 'required|string|max:255',
            'edad_esposa' => 'required|string|max:4',
            'origen_esposa' => 'required|string|max:255',
            'feligresesposa' => 'nullable|string|max:255',
            'nombre_padre_esposa' => 'required|string|max:255',
            'nombre_madre_esposa' => 'required|string|max:255',
            'nombre_parroco' => 'required|string|max:255',
        ], [
            'NoPartida.required' => 'El número de partida es obligatorio.',
            'folio.required' => 'El folio es obligatorio.',
            'fecha_casamiento.required' => 'La fecha del casamiento es obligatoria.',
            'nombres_testigos.required' => 'El nombre de los testigos es obligatorio.',
            'nombre_esposo.required' => 'El nombre del esposo es obligatorio.',
            'edad_esposo.required' => 'La edad del esposo es obligatoria.',
            'origen_esposo.required' => 'El origen del esposo es obligatorio.',
            'nombre_padre_esposo.required' => 'El nombre del padre del esposo es obligatorio.',
            'nombre_madre_esposo.required' => 'El nombre de la madre del esposo es obligatorio.',
            'nombre_esposa.required' => 'El nombre de la esposa es obligatorio.',
            'edad_esposa.required' => 'La edad de la esposa es obligatoria.',
            'origen_esposa.required' => 'El origen de la esposa es obligatorio.',
            'nombre_padre_esposa.required' => 'El nombre del padre de la esposa es obligatorio.',
            'nombre_madre_esposa.required' => 'El nombre de la madre de la esposa es obligatorio.',
            'nombre_parroco.required' => 'El nombre del párroco es obligatorio.',
        ]);

        $validatedData['dato_parroquia_id'] = 1;

        try {
            Casamiento::create($validatedData);
            return redirect()->route('casamientos.index')->with('success', 'Casamiento guardado exitosamente.');
        } catch (\Exception $e) {
            // Registra el error en el archivo de logs y muestra un mensaje en la vista
            Log::error('Error al guardar casamiento: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al guardar el casamiento: ' . $e->getMessage());
        }
    }
    public function show($casamiento_id)
    {
        // Buscar el casamiento por su ID
        $casamiento = Casamiento::findOrFail($casamiento_id);

        // Retornar la vista con los detalles del casamiento
        return view('casamiento.casamiento-show', compact('casamiento',));
    }

    /**
     * Actualiza un registro existente de casamiento en la base de datos.
     */
    public function update(Request $request, $casamiento_id)
    {
        // Validar los datos del formulario con las mismas reglas que el store
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_casamiento' => 'required|date',
            'nombres_testigos' => 'required|string',
            'nombre_esposo' => 'required|string|max:255',
            'edad_esposo' => 'required|string|max:4',
            'origen_esposo' => 'required|string|max:255',
            'feligresesposo' => 'nullable|string|max:255',
            'nombre_padre_esposo' => 'required|string|max:255',
            'nombre_madre_esposo' => 'required|string|max:255',
            'nombre_esposa' => 'required|string|max:255',
            'edad_esposa' => 'required|string|max:4',
            'origen_esposa' => 'required|string|max:255',
            'feligresesposa' => 'nullable|string|max:255',
            'nombre_padre_esposa' => 'required|string|max:255',
            'nombre_madre_esposa' => 'required|string|max:255',
            'nombre_parroco' => 'required|string|max:255',
        ], [
            'NoPartida.required' => 'El número de partida es obligatorio.',
            'folio.required' => 'El folio es obligatorio.',
            'fecha_casamiento.required' => 'La fecha del casamiento es obligatoria.',
            'nombres_testigos.required' => 'El nombre de los testigos es obligatorio.',
            'nombre_esposo.required' => 'El nombre del esposo es obligatorio.',
            'edad_esposo.required' => 'La edad del esposo es obligatoria.',
            'origen_esposo.required' => 'El origen del esposo es obligatorio.',
            'nombre_padre_esposo.required' => 'El nombre del padre del esposo es obligatorio.',
            'nombre_madre_esposo.required' => 'El nombre de la madre del esposo es obligatorio.',
            'nombre_esposa.required' => 'El nombre de la esposa es obligatorio.',
            'edad_esposa.required' => 'La edad de la esposa es obligatoria.',
            'origen_esposa.required' => 'El origen de la esposa es obligatorio.',
            'nombre_padre_esposa.required' => 'El nombre del padre de la esposa es obligatorio.',
            'nombre_madre_esposa.required' => 'El nombre de la madre de la esposa es obligatorio.',
            'nombre_parroco.required' => 'El nombre del párroco es obligatorio.',
        ]);

        // Buscar el casamiento por ID
        $casamiento = Casamiento::findOrFail($casamiento_id);

        // Actualizar los datos del casamiento con los valores validados
        $casamiento->update($validatedData);

        // Redirigir al listado de casamientos con un mensaje de éxito
        return redirect()->route('casamientos.index')->with('success', 'Casamiento actualizado exitosamente.');
    }

    public function generatePDF($casamiento_id)
    {
        // Buscar el casamiento por ID
        $casamiento = Casamiento::findOrFail($casamiento_id);

        // Cargar la vista del PDF y pasar los datos
        $pdf = PDF::loadView('pdf.casamiento', compact('casamiento'));

        // Retornar el PDF para verlo en el navegador (no descargar)
        return $pdf->stream('constancia-casamiento.pdf');
    }
}
