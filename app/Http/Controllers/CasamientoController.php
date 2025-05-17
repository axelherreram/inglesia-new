<?php


namespace App\Http\Controllers;

use App\Models\Casamiento;
use App\Models\Departamento;
use App\Models\Municipio;
use App\Models\Testigo;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use Illuminate\Support\Facades\Log;
class CasamientoController extends Controller
{
    /**
     * Muestra una lista de casamientos con paginación.
     */
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Crear la consulta base con las relaciones
        $query = Casamiento::with([
            'esposo',
            'esposa'
        ]);

        if ($search) {
            $query->where(function ($q) use ($search) {
                if (is_numeric($search)) {
                    $q->whereHas('esposo', function ($q) use ($search) {
                        $q->where('dpi_cui', 'LIKE', '%' . $search . '%');
                    })
                        ->orWhereHas('esposa', function ($q) use ($search) {
                            $q->where('dpi_cui', 'LIKE', '%' . $search . '%');
                        });
                } else {
                    $q->whereHas('esposo', function ($q) use ($search) {
                        $q->whereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ['%' . $search . '%']);
                    })
                        ->orWhereHas('esposa', function ($q) use ($search) {
                            $q->whereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ['%' . $search . '%']);
                        });
                }
            });
        }


        // Paginación de los resultados
        $casamientos = $query->paginate(10);

        // Mensaje en caso de no encontrar registros
        if ($casamientos->isEmpty()) {
            session()->flash('no_results', 'No se encontraron registros de casamientos con los datos especificados.');
        } else {
            session()->forget('no_results');
        }

        return view('casamientos.index', compact('casamientos'));
    }



    /**
     * Muestra el formulario para crear un nuevo casamiento.
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

        return view('casamientos.create', compact('departamentos', 'municipios'));
    }

    /**
     * Almacena un nuevo casamiento en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_casamiento' => 'required|date|before_or_equal:today',
            'origen_esposo' => 'required|string|max:255',
            'feligresesposo' => 'nullable|string|max:255',
            'origen_esposa' => 'required|string|max:255',
            'feligresesposa' => 'nullable|string|max:255',
            'esposo_id' => 'required|exists:personas,persona_id',
            'esposa_id' => 'required|exists:personas,persona_id',
            'sacerdote_id' => 'required|exists:personas,persona_id',
            'padre_esposo_id' => 'nullable|exists:personas,persona_id',
            'madre_esposo_id' => 'nullable|exists:personas,persona_id',
            'padre_esposa_id' => 'nullable|exists:personas,persona_id',
            'madre_esposa_id' => 'nullable|exists:personas,persona_id',
            'testigos' => 'nullable|array|distinct',
            'testigos.*' => 'exists:personas,persona_id',
    
        ], [
            'NoPartida.required' => 'El número de partida es obligatorio.',
            'folio.required' => 'El folio es obligatorio.',
            'fecha_casamiento.required' => 'La fecha del casamiento es obligatoria.',
            'fecha_casamiento.before_or_equal' => 'La fecha del casamiento no puede ser mayor a la fecha actual.',
            'origen_esposo.required' => 'El origen del esposo es obligatorio.',
            'esposo_id.required' => 'El esposo es obligatorio.',
            'esposa_id.required' => 'La esposa es obligatoria.',
            'sacerdote_id.required' => 'El sacerdote es obligatorio.',
            'testigos.*.exists' => 'Uno o más testigos no son válidos.',
            'testigos.distinct' => 'Los testigos no pueden repetirse.',
    
        ]);
    
        // Validación para asegurar que al menos un familiar esté ingresado
        if (!$request->padre_esposo_id && !$request->madre_esposo_id && !$request->padre_esposa_id && !$request->madre_esposa_id) {
            return redirect()->back()->withErrors([
                'familiares' => 'Debe ingresar al menos un familiar (padre o madre del esposo o de la esposa).',
            ]);
        }
    
        try {
            $casamiento = Casamiento::create($validatedData);
    
            // Obtener los datos del esposo y esposa
            $esposo = Persona::find($request->esposo_id);
            $esposa = Persona::find($request->esposa_id);
    
            // Si el esposo no tiene padres registrados, actualizarlos
            if (!$esposo->padre_id && $request->padre_esposo_id) {
                $esposo->update(['padre_id' => $request->padre_esposo_id]);
            }
            if (!$esposo->madre_id && $request->madre_esposo_id) {
                $esposo->update(['madre_id' => $request->madre_esposo_id]);
            }
    
            // Si la esposa no tiene padres registrados, actualizarlos
            if (!$esposa->padre_id && $request->padre_esposa_id) {
                $esposa->update(['padre_id' => $request->padre_esposa_id]);
            }
            if (!$esposa->madre_id && $request->madre_esposa_id) {
                $esposa->update(['madre_id' => $request->madre_esposa_id]);
            }
    
            // Guardar los testigos si existen
            if ($request->has('testigos') && is_array($request->testigos)) {
                foreach ($request->testigos as $persona_id) {
                    Testigo::create([
                        'casamiento_id' => $casamiento->casamiento_id,
                        'persona_id' => $persona_id
                    ]);
                }
            }
            return redirect()->route('casamientos.index')->with('success', 'Casamiento guardado exitosamente.');
        } catch (\Exception $e) {
            // Registra el error en el archivo de logs y muestra un mensaje en la vista
            Log::error('Error al guardar casamiento: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al guardar el casamiento: ' . $e->getMessage());
        }
    }
    


    /**
     * Muestra los detalles de un casamiento.
     */
    public function show($casamiento_id)
    {
        $casamiento = Casamiento::with([
            'esposo',
            'esposa',
            'sacerdote',
            'padreEsposo',
            'madreEsposo',
            'padreEsposa',
            'madreEsposa',
            'testigos.persona'
        ])->findOrFail($casamiento_id);

        return view('casamientos.show', compact('casamiento'));
    }


    public function destroy($testigo_id)
    {
        try {
            // Busca el testigo por su testigo_id
            $testigo = Testigo::findOrFail($testigo_id);

            // Elimina el testigo
            $testigo->delete();

            // Retorna una respuesta JSON de éxito
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            // Retorna una respuesta JSON de error
            return response()->json(['success' => false, 'message' => $e->getMessage()], 500);
        }
    }
    /**
     * Actualiza un registro de casamiento existente.
     */
    public function update(Request $request, $casamiento_id)
    {
        // Validar los datos del casamiento
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_casamiento' => 'required|date',
            'origen_esposo' => 'required|string|max:255',
            'feligresia_esposo' => 'nullable|string|max:255',
            'origen_esposa' => 'required|string|max:255',
            'feligresia_esposa' => 'nullable|string|max:255',
            'esposo_id' => 'required|exists:personas,persona_id',
            'esposa_id' => 'required|exists:personas,persona_id',
            'sacerdote_id' => 'required|exists:personas,persona_id',
            'padre_esposo_id' => 'nullable|exists:personas,persona_id',
            'madre_esposo_id' => 'nullable|exists:personas,persona_id',
            'padre_esposa_id' => 'nullable|exists:personas,persona_id',
            'madre_esposa_id' => 'nullable|exists:personas,persona_id',
            'testigos' => 'nullable|array', // Array de IDs de testigos
            'testigos.*' => 'exists:personas,persona_id', // Cada testigo debe existir en la tabla personas
        ]);

        // Buscar el casamiento
        $casamiento = Casamiento::findOrFail($casamiento_id);

        // Actualizar los datos del casamiento
        $casamiento->update($validatedData);

        // Sincronizar los testigos
        if ($request->has('testigos') && is_array($request->testigos)) {
            foreach ($request->testigos as $persona_id) {
                // Verifica si ya existe la relación para evitar duplicados
                if (!Testigo::where('casamiento_id', $casamiento->casamiento_id)->where('persona_id', $persona_id)->exists()) {
                    Testigo::create([
                        'casamiento_id' => $casamiento->casamiento_id,
                        'persona_id' => $persona_id
                    ]);
                }
            }
        }


        return redirect()->route('casamientos.index')->with('success', 'Casamiento actualizado exitosamente.');
    }

    public function edit($casamiento_id)
    {
        $casamiento = Casamiento::with([
            'esposo',
            'esposa',
            'sacerdote',
            'padreEsposo',
            'madreEsposo',
            'padreEsposa',
            'madreEsposa',
            'testigos.persona'
        ])->findOrFail($casamiento_id);

        $departamentos = Departamento::all();
        $municipios = Municipio::where('departamento_id', $casamiento->esposo->departamento_id ?? null)->get();

        return view('casamientos.edit', compact('casamiento', 'departamentos', 'municipios'));
    }

    /**
     * Genera el PDF de un casamiento.
     */
    public function generatePDF($casamiento_id)
    {
        $casamiento = Casamiento::findOrFail($casamiento_id);
        $pdf = PDF::loadView('casamientos.pdf', compact('casamiento'));
        return $pdf->stream('constancia-casamiento.pdf');
    }
}
