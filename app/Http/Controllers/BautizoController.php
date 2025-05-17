<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bautizo;
use App\Models\Municipio;
use App\Models\Departamento;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Persona;
class BautizoController extends Controller
{
    // Método para mostrar la lista de bautizos
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Crear la consulta base con las relaciones
        $query = Bautizo::with([
            'personaBautizada',
            'municipio',
            'departamento',
            'sacerdote',
            'padre',
            'madre',
            'padrino',
            'madrina'
        ]);

        if ($search) {
            // Si el input es solo números, buscar por CUI
            if (is_numeric($search)) {
                $query->whereHas('personaBautizada', function ($q) use ($search) {
                    $q->where('dpi_cui', 'LIKE', '%' . $search . '%');
                });
            } else {
                // Buscar por nombre + apellido
                $query->whereHas('personaBautizada', function ($q) use ($search) {
                    $q->whereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ['%' . $search . '%']);
                });
            }
        }

        // Paginación de los resultados
        $bautizos = $query->paginate(10);

        // Mensaje en caso de no encontrar registros
        if ($bautizos->isEmpty()) {
            session()->flash('no_results', 'No se encontraron registros de bautizos con los datos especificados.');
        } else {
            session()->forget('no_results');
        }

        return view('bautizos.index', compact('bautizos'));
    }

    /**
     * Muestra el formulario para crear un bautizo.
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

        return view('bautizos.create', compact('departamentos', 'municipios'));
    }
    /**
     * Almacena un nuevo registro de bautizo
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'persona_bautizada_id' => 'required|exists:personas,persona_id',
            'NoPartida' => 'required|string|min:3|max:20|unique:bautizos,NoPartida',
            'folio' => 'required|string|min:3|max:50|unique:bautizos,folio',
            'fecha_bautizo' => 'required|date|before_or_equal:today',
            'aldea' => 'required|string|max:255',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'sacerdote_id' => 'required|exists:personas,persona_id',
            'padre_id' => 'nullable|exists:personas,persona_id',
            'madre_id' => 'nullable|exists:personas,persona_id',
            'padrino_id' => 'nullable|exists:personas,persona_id',
            'madrina_id' => 'nullable|exists:personas,persona_id',
            'margen' => 'required|string|max:200',
        ], [
            'persona_bautizada_id.required' => 'El campo persona bautizada es obligatorio.',
            'persona_bautizada_id.exists' => 'La persona bautizada no existe.',
            'NoPartida.required' => 'El número de partida es obligatorio.',
            'NoPartida.string' => 'El número de partida debe ser una cadena de texto.',
            'NoPartida.min' => 'El número de partida debe tener al menos 3 caracteres.',
            'NoPartida.max' => 'El número de partida no puede exceder los 20 caracteres.',
            'NoPartida.unique' => 'El número de partida ya está registrado.',
            'folio.required' => 'El folio es obligatorio.',
            'folio.string' => 'El folio debe ser una cadena de texto.',
            'folio.min' => 'El folio debe tener al menos 3 caracteres.',
            'folio.max' => 'El folio no puede exceder los 50 caracteres.',
            'folio.unique' => 'El folio ya está registrado.',
            'fecha_bautizo.required' => 'La fecha de bautizo es obligatoria.',
            'fecha_bautizo.date' => 'La fecha de bautizo debe ser una fecha válida.',
            'fecha_bautizo.before_or_equal' => 'La fecha de bautizo no puede ser futura.',
            'aldea.required' => 'El campo aldea es obligatorio.',
            'aldea.string' => 'La aldea debe ser una cadena de texto.',
            'aldea.max' => 'La aldea no puede exceder los 255 caracteres.',
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
            'margen.required' => 'El campo margen es obligatorio.',
            'margen.string' => 'El margen debe ser una cadena de texto.',
            'margen.max' => 'El margen no puede exceder los 200 caracteres.',
        ]);

        if (!$request->padre_id && !$request->madre_id) {
            return redirect()->back()->withErrors([
                'padre_id' => 'Debe registrar al menos un padre o una madre.',
                'madre_id' => 'Debe registrar al menos un padre o una madre.',
            ]);
        }

        // Verificar si ya existe un bautizo para la persona bautizada
        $bautizoExistente = Bautizo::where('persona_bautizada_id', $request->persona_bautizada_id)->first();
        if ($bautizoExistente) {
            return redirect()->back()->withErrors([
                'persona_bautizada_id' => 'Esta persona ya ha sido bautizada previamente.',
            ]);
        }

        // Validación personalizada para asegurarse de que el mismo persona_id no esté en varios campos
        $personaIds = [
            $request->persona_bautizada_id,
            $request->sacerdote_id,
            $request->padre_id,
            $request->madre_id,
            $request->padrino_id,
            $request->madrina_id,
        ];

        // Eliminar valores nulos para verificar solo los campos con persona_id
        $personaIds = array_filter($personaIds, function ($value) {
            return !is_null($value);
        });

        if (count($personaIds) !== count(array_unique($personaIds))) {
            return redirect()->back()->withErrors([
                'persona_bautizada_id' => 'El mismo persona_id no puede ser usado en varios campos.',
            ]);
        }

        Bautizo::create($validatedData);

        // Actualizar la persona bautizada con los IDs de sus familiares
        $personaBautizada = Persona::find($request->persona_bautizada_id);
        if ($personaBautizada) {
            $personaBautizada->update([
                'padre_id' => $request->padre_id,
                'madre_id' => $request->madre_id,
                'padrino_id' => $request->padrino_id,
                'madrina_id' => $request->madrina_id,
            ]);
        }


        return redirect()->route('bautizos.index')->with('success', 'Bautizo guardado exitosamente.');
    }

    public function show($bautizo_id)
    {
        $bautizo = Bautizo::with([
            'personaBautizada',
            'municipio',
            'departamento',
            'sacerdote',
            'padre',
            'madre',
            'padrino',
            'madrina'
        ])->findOrFail($bautizo_id);

        $departamentos = Departamento::all();

        return view('bautizos.show', compact('bautizo', 'departamentos'));
    }
    public function edit($bautizo_id)
    {
        $bautizo = Bautizo::with([
            'personaBautizada',
            'municipio',
            'departamento',
            'sacerdote',
            'padre',
            'madre',
            'padrino',
            'madrina'
        ])->findOrFail($bautizo_id);

        $departamentos = Departamento::all();
        $municipios = Municipio::where('departamento_id', $bautizo->departamento_id)->get();

        return view('bautizos.edit', compact('bautizo', 'departamentos', 'municipios'));
    }
    public function update(Request $request, $bautizo_id)
    {
        $validatedData = $request->validate([
            'persona_bautizada_id' => 'required|exists:personas,persona_id',
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_bautizo' => 'required|date',
            'aldea' => 'nullable|string|max:255',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'sacerdote_id' => 'nullable|exists:personas,persona_id',
            'padre_id' => 'nullable|exists:personas,persona_id',
            'madre_id' => 'nullable|exists:personas,persona_id',
            'padrino_id' => 'nullable|exists:personas,persona_id',
            'madrina_id' => 'nullable|exists:personas,persona_id',
            'margen' => 'nullable|string|max:200',
        ]);

        $bautizo = Bautizo::findOrFail($bautizo_id);
        $bautizo->update($validatedData);
        return redirect()->route('bautizos.index')->with('success', 'Bautizo actualizado exitosamente.');
    }


    public function generatePDF($bautizo_id)
    {
        $bautizo = Bautizo::with(['personaBautizada', 'municipio', 'departamento', 'sacerdote', 'padre', 'madre', 'padrino', 'madrina'])->findOrFail($bautizo_id);
        $pdf = PDF::loadView('bautizos.pdf', compact('bautizo'));
        return $pdf->stream('constancia-bautizo.pdf');
    }

    public function getMunicipios($departamento_id)
    {
        $municipios = Municipio::where('departamento_id', $departamento_id)->get();
        return response()->json($municipios);
    }

}
