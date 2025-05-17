<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comunion;
use App\Models\Municipio;
use App\Models\Departamento;
use Barryvdh\DomPDF\Facade\Pdf as PDF;
use App\Models\Persona;

class ComunionController extends Controller
{
    // Método para mostrar la lista de comuniones
    public function index(Request $request)
    {
        $search = $request->input('search');

        // Consulta base con relaciones
        $query = Comunion::with([
            'personaParticipe',
            'municipio',
            'departamento',
            'sacerdote',
            'padre',
            'madre'
        ]);

        if ($search) {
            $query->whereHas('personaParticipe', function ($q) use ($search) {
                if (ctype_digit($search)) { // Verifica si el input es solo dígitos
                    $q->where('dpi_cui', 'LIKE', '%' . $search . '%'); // Permite buscar incluso si hay ceros a la izquierda
                } else {
                    $q->whereRaw("CONCAT(nombres, ' ', apellidos) LIKE ?", ['%' . $search . '%']);
                }
            });
        }

        $comuniones = $query->paginate(10);

        // Mensaje si no hay resultados
        if ($comuniones->isEmpty()) {
            session()->flash('no_results', 'No se encontraron registros de comuniones con los datos especificados.');
        } else {
            session()->forget('no_results');
        }

        return view('comuniones.index', compact('comuniones'));
    }


    /**
     * Muestra el formulario para crear una comunión.
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

        return view('comuniones.create', compact('departamentos', 'municipios'));
    }

    /**
     * Almacena un nuevo registro de comunión en la base de datos.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'persona_participe_id' => 'required|exists:personas,persona_id',
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_comunion' => 'required|date|before_or_equal:today',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'sacerdote_id' => 'required|exists:personas,persona_id',
            'padre_id' => 'nullable|exists:personas,persona_id',
            'madre_id' => 'nullable|exists:personas,persona_id',
        ], [
            'persona_participe_id.required' => 'El campo persona participe es obligatorio.',
            'persona_participe_id.exists' => 'La persona participante no está registrada en el sistema.',
            'NoPartida.required' => 'El campo número de partida es obligatorio.',
            'NoPartida.string' => 'El número de partida debe ser una cadena de texto.',
            'NoPartida.max' => 'El número de partida no puede exceder los 20 caracteres.',
            'folio.required' => 'El campo folio es obligatorio.',
            'folio.string' => 'El folio debe ser una cadena de texto.',
            'folio.max' => 'El folio no puede exceder los 50 caracteres.',
            'fecha_comunion.required' => 'La fecha de comunión es obligatoria.',
            'fecha_comunion.date' => 'La fecha de comunión debe ser una fecha válida.',
            'fecha_comunion.before_or_equal' => 'La fecha de comunión no puede ser mayor a la fecha actual.',
            'municipio_id.required' => 'El municipio es obligatorio.',
            'municipio_id.exists' => 'El municipio seleccionado no está registrado en el sistema.',
            'departamento_id.required' => 'El departamento es obligatorio.',
            'departamento_id.exists' => 'El departamento seleccionado no está registrado en el sistema.',
            'sacerdote_id.required' => 'El sacerdote es obligatorio.',
            'sacerdote_id.exists' => 'El sacerdote seleccionado no está registrado en el sistema.',
            'padre_id.exists' => 'El padre no está registrado en el sistema.',
            'madre_id.exists' => 'La madre no está registrada en el sistema.',
        ]);

        // Validación personalizada: debe haber al menos un padre o una madre
        if (!$request->padre_id && !$request->madre_id) {
            return redirect()->back()->withErrors([
                'padre_id' => 'Debe registrar al menos un padre o una madre.',
                'madre_id' => 'Debe registrar al menos un padre o una madre.',
            ]);
        }

        // Verificar si ya existe una comunión para la persona participe
        $comunionExistente = Comunion::where('persona_participe_id', $request->persona_participe_id)->first();
        if ($comunionExistente) {
            return redirect()->back()->withErrors([
                'persona_participe_id' => 'Esta persona ya ha realizado la comunión previamente.',
            ]);
        }

        // Validación personalizada para asegurarse de que el mismo persona_id no esté en varios campos
        $personaIds = [
            $request->persona_participe_id,
            $request->sacerdote_id,
            $request->padre_id,
            $request->madre_id,
        ];

        // Eliminar valores nulos para verificar solo los campos con persona_id
        $personaIds = array_filter($personaIds, function ($value) {
            return !is_null($value);
        });

        if (count($personaIds) !== count(array_unique($personaIds))) {
            return redirect()->back()->withErrors([
                'persona_participe_id' => 'La misma persona no puede ser usada en varios campos.',
            ]);
        }

        // Crear la comunión
        Comunion::create($validatedData);

        // Actualizar la persona participe con los IDs de sus familiares solo si no tiene padres registrados
        $personaParticipe = Persona::find($request->persona_participe_id);
        if ($personaParticipe) {
            if (!$personaParticipe->padre_id && !$personaParticipe->madre_id) {
                $personaParticipe->update([
                    'padre_id' => $request->padre_id,
                    'madre_id' => $request->madre_id,
                ]);
            }
        }

        return redirect()->route('comuniones.index')->with('success', 'Comunión guardada exitosamente.');
    }


    public function show($comunion_id)
    {
        $comunion = Comunion::with([
            'personaParticipe',
            'municipio',
            'departamento',
            'sacerdote',
            'padre',
            'madre'
        ])->findOrFail($comunion_id);

        $departamentos = Departamento::all();

        return view('comuniones.show', compact('comunion', 'departamentos'));
    }

    public function edit($comunion_id)
    {
        $comunion = Comunion::with([
            'personaParticipe',
            'municipio',
            'departamento',
            'sacerdote',
            'padre',
            'madre'
        ])->findOrFail($comunion_id);

        $departamentos = Departamento::all();
        $municipios = Municipio::where('departamento_id', $comunion->departamento_id)->get();

        return view('comuniones.edit', compact('comunion', 'departamentos', 'municipios'));
    }

    public function update(Request $request, $comunion_id)
    {
        $validatedData = $request->validate([
            'persona_participe_id' => 'required|exists:personas,persona_id',
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_comunion' => 'required|date',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'sacerdote_id' => 'nullable|exists:personas,persona_id',
            'padre_id' => 'nullable|exists:personas,persona_id',
            'madre_id' => 'nullable|exists:personas,persona_id',
        ]);

        $comunion = Comunion::findOrFail($comunion_id);
        $comunion->update($validatedData);
        return redirect()->route('comuniones.index')->with('success', 'Comunión actualizada exitosamente.');
    }

    public function generatePDF($comunion_id)
    {
        $comunion = Comunion::with(['personaParticipe', 'municipio', 'departamento', 'sacerdote', 'padre', 'madre'])->findOrFail($comunion_id);
        $pdf = PDF::loadView('comuniones.pdf', compact('comunion'));
        return $pdf->stream('constancia-comunion.pdf');
    }

    public function getMunicipios($departamento_id)
    {
        $municipios = Municipio::where('departamento_id', $departamento_id)->get();
        return response()->json($municipios);
    }
}
