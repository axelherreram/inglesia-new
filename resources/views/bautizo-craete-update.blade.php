@extends('layouts.app')

@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <style>
        .card {
            max-width: 800px;
            margin: 0 auto;
        }

        .row.mb-3 {
            margin-bottom: 1.5rem;
        }

        .text-danger {
            font-size: 0.875rem;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-header bg-transparent">
                    <a href="dashboard" class="btn btn-sm btn-primary-ig-r">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h3 class="mt-3">Crear nuevo bautizo</h3>
                </div>

                <form action="{{ route('bautizos.store') }}" method="POST" class="p-4">
                    @csrf
                    <!-- Correlativo y Fecha del Bautizo -->
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
                            <label for="fecha_bautizo" class="form-label">Fecha de bautizo:</label>
                            <input type="date" class="form-control" id="fecha_bautizo" name="fecha_bautizo" value="{{ old('fecha_bautizo') }}">
                            @error('fecha_bautizo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de la persona bautizada -->
                    <div class="row mb-3">
                        <label for="nombre_persona_bautizada" class="col-sm-3 col-form-label">Nombre de la persona bautizada:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre_persona_bautizada" name="nombre_persona_bautizada" value="{{ old('nombre_persona_bautizada') }}">
                            @error('nombre_persona_bautizada')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Fecha de Nacimiento y edad -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="edad" class="form-label">Edad:</label>
                            <input type="text" class="form-control" id="edad" name="edad" value="{{ old('edad') }}">
                            @error('edad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
                            @error('fecha_nacimiento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Aldea -->
                    <div class="row mb-3">
                        <label for="aldea" class="col-sm-2 col-form-label">Aldea:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="aldea" name="aldea" value="{{ old('aldea') }}">
                            @error('aldea')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Ubicación -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="departamento" class="form-label">Departamento:</label>
                            <select class="form-control" id="departamento" name="departamento_id">
                                <option value="">Seleccione el departamento</option>
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
                            <label for="municipio" class="form-label">Municipio:</label>
                            <select class="form-control" id="municipio" name="municipio_id">
                                <option value="">Seleccione el municipio</option>
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

                    <!-- Datos de los Padres -->
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

                    <!-- Datos del Sacerdote -->
                    <div class="row mb-3">
                        <label for="nombre_sacerdote" class="col-sm-3 col-form-label">Nombre del sacerdote:</label>
                        <input type="text" class="form-control" id="nombre_sacerdote" name="nombre_sacerdote" value="{{ old('nombre_sacerdote') }}">
                        @error('nombre_sacerdote')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Datos de los Padrinos -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre_padrino" class="form-label">Nombre del padrino:</label>
                            <input type="text" class="form-control" id="nombre_padrino" name="nombre_padrino" value="{{ old('nombre_padrino') }}">
                            @error('nombre_padrino')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="nombre_madrina" class="form-label">Nombre de la madrina:</label>
                            <input type="text" class="form-control" id="nombre_madrina" name="nombre_madrina" value="{{ old('nombre_madrina') }}">
                            @error('nombre_madrina')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Margen -->
                    <div class="row mb-3">
                        <label for="margen" class="col-sm-2 col-form-label">Margen:</label>
                        <textarea class="form-control" id="margen" name="margen">{{ old('margen') }}</textarea>
                        @error('margen')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botón de Guardar -->
                    <div class="row mt-3">
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary-ig w-25 w-sm-25">Guardar</button>
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
        const departamentoSelect = document.getElementById('departamento');
        const municipioSelect = document.getElementById('municipio');

        // Si ya hay un departamento seleccionado, cargar sus municipios
        if (departamentoSelect.value) {
            const departamentoId = departamentoSelect.value;
            fetch(`/municipios/${departamentoId}`)
                .then(response => response.json())
                .then(data => {
                    data.forEach(municipio => {
                        const option = document.createElement('option');
                        option.value = municipio.municipio_id;
                        option.textContent = municipio.municipio;
                        option.selected = municipio.municipio_id === "{{ old('municipio_id') }}";
                        municipioSelect.appendChild(option);
                    });
                })
                .catch(error => {
                    console.error('Error al obtener los municipios:', error);
                });
        }

        // Evento cuando se cambia el departamento
        departamentoSelect.addEventListener('change', function() {
            municipioSelect.innerHTML = '<option value="">Seleccione el municipio</option>';
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

@endsection
