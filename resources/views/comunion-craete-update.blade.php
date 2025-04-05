@extends('layouts.app')

@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <style>
        .card {
            max-width: 800px;
            margin: 0 auto;
        }

        .text-danger {
            color: red;
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-header bg-transparent">
                    <a href="dashboard" class="btn btn-sm btn-primary-ig-r ">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h3 class="mt-3">Crear nueva primera comunión</h3>
                </div>

                <form action="{{ route('comuniones.store') }}" method="POST" class="p-4">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="NoPartida" class="form-label">Partida No:</label>
                            <input type="text" class="form-control" id="NoPartida" name="NoPartida" value="{{ old('NoPartida') }}">
                            @error('NoPartida')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="folio" class="form-label">Folio:</label>
                            <input type="text" class="form-control" id="folio" name="folio" value="{{ old('folio') }}">
                            @error('folio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="fecha_comunion" class="form-label">Fecha de Comunión:</label>
                            <input type="date" class="form-control" id="fecha_comunion" name="fecha_comunion" value="{{ old('fecha_comunion') }}">
                            @error('fecha_comunion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos Persona de la primera comunión -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="nombre_persona_participe" class="form-label">Nombre de la persona de la primera comunión:</label>
                            <input type="text" class="form-control" id="nombre_persona_participe" name="nombre_persona_participe" value="{{ old('nombre_persona_participe') }}">
                            @error('nombre_persona_participe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Fecha de nacimiento -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                            @error('fecha_nacimiento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de los Padres -->
                    <span><strong>Datos padres</strong></span>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre_padre" class="form-label">Nombre del padre:</label>
                            <input type="text" class="form-control" id="nombre_padre" name="nombre_padre" value="{{ old('nombre_padre') }}">
                            @error('nombre_padre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="nombre_madre" class="form-label">Nombre de la madre:</label>
                            <input type="text" class="form-control" id="nombre_madre" name="nombre_madre" value="{{ old('nombre_madre') }}">
                            @error('nombre_madre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de ubicación -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="departamento_id" class="form-label">Departamento:</label>
                            <select class="form-control" id="departamento_id" name="departamento_id">
                                <option value="">Seleccione departamento</option>
                                @foreach ($departamentos as $departamento)
                                    <option value="{{ $departamento->departamento_id }}" {{ old('departamento_id') == $departamento->departamento_id ? 'selected' : '' }}>
                                        {{ $departamento->depto }}
                                    </option>
                                @endforeach
                            </select>
                            @error('departamento_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="municipio_id" class="form-label">Municipio:</label>
                            <select class="form-control" id="municipio_id" name="municipio_id">
                                <option value="">Seleccione municipio</option>
                                @foreach ($municipios as $municipio)
                                    <option value="{{ $municipio->municipio_id }}" {{ old('municipio_id') == $municipio->municipio_id ? 'selected' : '' }}>
                                        {{ $municipio->municipio }}
                                    </option>
                                @endforeach
                            </select>
                            
                            @error('municipio_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary-ig w-25 w-sm-100">Guardar</button>
                        </div>
                    </div>
                </form>

            </div>
        </div>
    </div>
@endsection

@section('script')
<script>
    document.addEventListener("DOMContentLoaded", function () {
        const departamentoSelect = document.getElementById('departamento_id');
        const municipioSelect = document.getElementById('municipio_id');

        // Cargar municipios si hay un departamento seleccionado
        if (departamentoSelect.value) {
            fetch(`/municipios/${departamentoSelect.value}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.municipio_id;
                        option.textContent = municipio.municipio;
                        option.selected = municipio.municipio_id == "{{ old('municipio_id') }}";
                        municipioSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los municipios:', error);
                });
        }

        // Cargar municipios en el cambio de departamento
        departamentoSelect.addEventListener('change', function() {
            municipioSelect.innerHTML = '<option value="">Seleccione municipio</option>';
            if (departamentoSelect.value) {
                fetch(`/municipios/${departamentoSelect.value}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(municipio => {
                            const option = document.createElement('option');
                            option.value = municipio.municipio_id;
                            option.textContent = municipio.municipio;
                            municipioSelect.appendChild(option);
                        });
                    })
                    .catch(error => {
                        console.error('Error al obtener los municipios:', error);
                    });
            }
        });
    });
</script>


    <!--plugins-->
    <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/plugins/chartjs/js/chart.js"></script>
    <script src="assets/plugins/sparkline-charts/jquery.sparkline.min.js"></script>
    <!--Morris JavaScript -->
    <script src="assets/plugins/raphael/raphael-min.js"></script>
    <script src="assets/plugins/morris/js/morris.js"></script>
    <script src="assets/js/index2.js"></script>
@endsection
