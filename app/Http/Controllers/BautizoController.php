<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Bautizo;
use App\Models\Municipio;
use App\Models\Departamento;
use Barryvdh\DomPDF\Facade\Pdf as PDF;

class BautizoController extends Controller
{
    // Método para mostrar la lista de bautizos
    public function index(Request $request)
    {
        // Obtener los valores de búsqueda
        $nombre = $request->input('nombre');
        $apellido = $request->input('apellido');
        $anio = $request->input('anio');

        // Consulta inicial para los bautizos
        $query = Bautizo::query();

        // Filtros de búsqueda
        if ($nombre) {
            $query->where('nombre_persona_bautizada', 'like', '%' . $nombre . '%');
        }

        if ($apellido) {
            $query->where('apellido_persona_bautizada', 'like', '%' . $apellido . '%');
        }

        if ($anio) {
            $query->whereYear('fecha_bautizo', $anio);
        }

        $bautizos = $query->paginate(10);

        if ($bautizos->isEmpty()) {
            session()->flash('no_results', 'No se encontraron registros de bautizos con los datos especificados.');
        } else {
            session()->forget('no_results');
        }
        // Retornar la vista 'dashboard-list-bautizo' con los bautizos
        return view('list-bautizo', compact('bautizos'));
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

        return view('bautizo-craete-update', compact('departamentos', 'municipios'));
    }


    /**
     * Almacena un nuevo registro de bautizo en la base de datos.
     */
    public function store(Request $request)
    {
        // Validar los datos del formulario
        // Validar los datos del formulario
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_bautizo' => 'required|date',
            'nombre_persona_bautizada' => 'required|string|max:255',
            'edad' => 'nullable|string|max:4',
            'fecha_nacimiento' => 'required|date|before_or_equal:today',
            'aldea' => 'nullable|string|max:255',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'nombre_padre' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'nombre_sacerdote' => 'nullable|string|max:255',
            'nombre_padrino' => 'nullable|string|max:255',
            'nombre_madrina' => 'nullable|string|max:255',
            'margen' => 'nullable|string|max:200',
        ], [
            // Mensajes de error personalizados
            'NoPartida.required' => 'El número de partida es obligatorio.',
            'NoPartida.string' => 'El número de partida debe ser una cadena de texto.',
            'NoPartida.max' => 'El número de partida no puede tener más de 20 caracteres.',

            'folio.required' => 'El folio es obligatorio.',
            'folio.string' => 'El folio debe ser una cadena de texto.',
            'folio.max' => 'El folio no puede tener más de 50 caracteres.',

            'fecha_bautizo.required' => 'La fecha de bautizo es obligatoria.',
            'fecha_bautizo.date' => 'La fecha de bautizo debe ser una fecha válida.',

            'nombre_persona_bautizada.required' => 'El nombre de la persona bautizada es obligatorio.',
            'nombre_persona_bautizada.string' => 'El nombre de la persona bautizada debe ser una cadena de texto.',
            'nombre_persona_bautizada.max' => 'El nombre de la persona bautizada no puede tener más de 255 caracteres.',

            'edad.string' => 'La edad debe ser una cadena de texto.',
            'edad.max' => 'La edad no puede tener más de 4 caracteres.',
            
            'fecha_nacimiento.required' => 'La fecha de nacimiento es obligatoria.',
            'fecha_nacimiento.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser mayor que la fecha actual.',

            'aldea.string' => 'La aldea debe ser una cadena de texto.',
            'aldea.max' => 'La aldea no puede tener más de 255 caracteres.',

            'municipio_id.required' => 'El municipio es obligatorio.',
            'municipio_id.exists' => 'El municipio seleccionado no es válido.',

            'departamento_id.required' => 'El departamento es obligatorio.',
            'departamento_id.exists' => 'El departamento seleccionado no es válido.',

            'nombre_padre.string' => 'El nombre del padre debe ser una cadena de texto.',
            'nombre_padre.max' => 'El nombre del padre no puede tener más de 255 caracteres.',

            'nombre_madre.string' => 'El nombre de la madre debe ser una cadena de texto.',
            'nombre_madre.max' => 'El nombre de la madre no puede tener más de 255 caracteres.',

            'nombre_sacerdote.string' => 'El nombre del sacerdote debe ser una cadena de texto.',
            'nombre_sacerdote.max' => 'El nombre del sacerdote no puede tener más de 255 caracteres.',

            'nombre_padrino.string' => 'El nombre del padrino debe ser una cadena de texto.',
            'nombre_padrino.max' => 'El nombre del padrino no puede tener más de 255 caracteres.',

            'nombre_madrina.string' => 'El nombre de la madrina debe ser una cadena de texto.',
            'nombre_madrina.max' => 'El nombre de la madrina no puede tener más de 255 caracteres.',

            'margen.string' => 'El margen debe ser una cadena de texto.',
            'margen.max' => 'El margen no puede tener más de 200 caracteres.',
        ]);


        // Crear un nuevo registro en la tabla 'bautizo'
        Bautizo::create([
            'NoPartida' => $validatedData['NoPartida'],
            'folio' => $validatedData['folio'],
            'fecha_bautizo' => $validatedData['fecha_bautizo'],
            'nombre_persona_bautizada' => $validatedData['nombre_persona_bautizada'],
            'edad' => $validatedData['edad'],
            'fecha_nacimiento' => $validatedData['fecha_nacimiento'],
            'aldea' => $validatedData['aldea'],
            'municipio_id' => $validatedData['municipio_id'],
            'departamento_id' => $validatedData['departamento_id'],
            'nombre_padre' => $validatedData['nombre_padre'],
            'nombre_madre' => $validatedData['nombre_madre'],
            'nombre_sacerdote' => $validatedData['nombre_sacerdote'],
            'nombre_padrino' => $validatedData['nombre_padrino'],
            'nombre_madrina' => $validatedData['nombre_madrina'],
            'margen' => $validatedData['margen'],
        ]);

        // Redirigir al usuario a la página deseada, por ejemplo, el listado de bautizos
        return redirect()->route('bautizos.index')->with('success', 'Bautizo guardado exitosamente.');
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

    public function show($bautizo_id)
    {
        $bautizo = Bautizo::findOrFail($bautizo_id);
        $departamentos = Departamento::all(); // Para los selectores
        return view('bautizos.show', compact('bautizo', 'departamentos'));
    }
    public function update(Request $request, $bautizo_id)
    {
        // Validación de los datos
        $validatedData = $request->validate([
            'NoPartida' => 'required|string|max:20',
            'folio' => 'required|string|max:50',
            'fecha_bautizo' => 'required|date',
            'nombre_persona_bautizada' => 'required|string|max:255',
            'edad' => 'nullable|string|max:4',
            'fecha_nacimiento' => 'nullable|date|before_or_equal:today',
            'aldea' => 'nullable|string|max:255',
            'municipio_id' => 'required|exists:municipio,municipio_id',
            'departamento_id' => 'required|exists:departamento,departamento_id',
            'nombre_padre' => 'nullable|string|max:255',
            'nombre_madre' => 'nullable|string|max:255',
            'nombre_sacerdote' => 'nullable|string|max:255',
            'nombre_padrino' => 'nullable|string|max:255',
            'nombre_madrina' => 'nullable|string|max:255',
            'margen' => 'nullable|string|max:200',
        ], [
            'fecha_nacimiento.before_or_equal' => 'La fecha de nacimiento no puede ser mayor que la fecha actual.',
        ]);

        // Buscar el bautizo y actualizarlo
        $bautizo = Bautizo::findOrFail($bautizo_id);
        $bautizo->update($validatedData);

        return redirect()->route('bautizos.index')->with('success', 'Bautizo actualizado exitosamente.');
    }
    public function generatePDF($bautizo_id)
    {
        $bautizo = Bautizo::findOrFail($bautizo_id);

        // Cargar la vista del PDF y pasar los datos
        $pdf = PDF::loadView('pdf.bautizo', compact('bautizo'));

        return $pdf->stream('constancia-bautizo.pdf');
    }
}
