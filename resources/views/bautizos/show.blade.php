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

        .cancel-custom {
            color: #000000 !important;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-header bg-transparent">
                    <a href="{{ route('bautizos.index') }}" class="btn btn-sm btn-primary-ig-r">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>

                    <h3 class="mt-3">Actualizar detalles del Bautizo</h3>

                </div>
                <form action="{{ route('bautizos.update', $bautizo->bautizo_id) }}" method="POST" id="formGuardar"
                    class="p-4">
                    @csrf
                    @method('PUT') <!-- Esto es importante para indicar que es una actualización -->

                    <!-- Correlativo y Fecha del Bautizo -->
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="NoPartida" class="form-label">Partida No:</label>
                            <input type="text" class="form-control" id="NoPartida" name="NoPartida"
                                value="{{ old('NoPartida', $bautizo->NoPartida) }}">
                            @error('NoPartida')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="folio" class="form-label">Folio:</label>
                            <input type="text" class="form-control" id="folio" name="folio"
                                value="{{ old('folio', $bautizo->folio) }}">
                            @error('folio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="fecha_bautizo" class="form-label">Fecha de bautizo:</label>
                            <input type="date" class="form-control" id="fecha_bautizo" name="fecha_bautizo"
                                value="{{ old('fecha_bautizo', $bautizo->fecha_bautizo ? \Carbon\Carbon::parse($bautizo->fecha_bautizo)->format('Y-m-d') : '') }}">
                            @error('fecha_bautizo')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de la persona bautizada -->
                    <div class="row mb-3">
                        <label for="nombre_persona_bautizada" class="col-sm-3 col-form-label">Nombre de la persona
                            bautizada:</label>
                        <div class="col-sm-9">
                            <input type="text" class="form-control" id="nombre_persona_bautizada"
                                name="nombre_persona_bautizada"
                                value="{{ old('nombre_persona_bautizada', $bautizo->nombre_persona_bautizada) }}">
                            @error('nombre_persona_bautizada')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Fecha de Nacimiento y edad -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="edad" class="form-label">Edad:</label>
                            <input type="text" class="form-control" id="edad" name="edad"
                                value="{{ old('edad', $bautizo->edad) }}">
                            @error('edad')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento', $bautizo->fecha_nacimiento ? \Carbon\Carbon::parse($bautizo->fecha_nacimiento)->format('Y-m-d') : '') }}">
                            @error('fecha_nacimiento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Aldea -->
                    <div class="row mb-3">
                        <label for="aldea" class="col-sm-2 col-form-label">Aldea:</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="aldea" name="aldea"
                                value="{{ old('aldea', $bautizo->aldea) }}">
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
                                    <option value="{{ $departamento->departamento_id }}"
                                        {{ old('departamento_id', $bautizo->departamento_id) == $departamento->departamento_id ? 'selected' : '' }}>
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
                            <input type="text" class="form-control" id="nombre_padre" name="nombre_padre"
                                value="{{ old('nombre_padre', $bautizo->nombre_padre) }}">
                            @error('nombre_padre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="nombre_madre" class="form-label">Nombre de la madre:</label>
                            <input type="text" class="form-control" id="nombre_madre" name="nombre_madre"
                                value="{{ old('nombre_madre', $bautizo->nombre_madre) }}">
                            @error('nombre_madre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos del Sacerdote -->
                    <div class="row mb-3">
                        <label for="nombre_sacerdote" class="col-sm-3 col-form-label">Nombre del sacerdote:</label>
                        <input type="text" class="form-control" id="nombre_sacerdote" name="nombre_sacerdote"
                            value="{{ old('nombre_sacerdote', $bautizo->nombre_sacerdote) }}">
                        @error('nombre_sacerdote')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Datos de los Padrinos -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre_padrino" class="form-label">Nombre del padrino:</label>
                            <input type="text" class="form-control" id="nombre_padrino" name="nombre_padrino"
                                value="{{ old('nombre_padrino', $bautizo->nombre_padrino) }}">
                            @error('nombre_padrino')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="nombre_madrina" class="form-label">Nombre de la madrina:</label>
                            <input type="text" class="form-control" id="nombre_madrina" name="nombre_madrina"
                                value="{{ old('nombre_madrina', $bautizo->nombre_madrina) }}">
                            @error('nombre_madrina')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Margen -->
                    <div class="row mb-3">
                        <label for="margen" class="col-sm-2 col-form-label">Margen:</label>
                        <textarea class="form-control" id="margen" name="margen">{{ old('margen', $bautizo->margen) }}</textarea>
                        @error('margen')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Botón de Guardar y Imprimir a PDF -->
                    <div class="row mt-3">
                        <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end mb-2 mb-md-0">
                            <button type="button" class="btn btn-primary-ig w-100 w-md-50 me-md-2"
                                id="btnGuardar">Guardar cambios</button>
                        </div>
                         <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                            <button type="button" class="btn btn-secondary w-100 w-md-50" onclick="window.open('{{ route('bautizo.pdf', $bautizo->bautizo_id) }}', '_blank')">Imprimir a PDF</button>
                        </div>
                    </div>


                </form>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        document.getElementById('btnGuardar').addEventListener('click', function(e) {
            e.preventDefault(); // Evitar que se envíe automáticamente el formulario

            Swal.fire({
                title: '¿Estás seguro?',
                text: "Se guardarán los cambios del registro.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#ffe6a7',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    cancelButton: 'cancel-custom' // Clase personalizada para el botón cancelar
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formGuardar').submit(); // Enviar el formulario si confirma
                }
            });
        });
        document.addEventListener('DOMContentLoaded', function() {
            const departamentoSelect = document.getElementById('departamento');
            const municipioSelect = document.getElementById('municipio');
            const municipioSeleccionado = "{{ old('municipio_id', $bautizo->municipio_id) }}";

            // Cargar municipios al cambiar el departamento
            departamentoSelect.addEventListener('change', function() {
                const departamentoId = this.value;
                cargarMunicipios(departamentoId);
            });

            // Cargar municipios al cargar la página si hay un departamento seleccionado
            if (departamentoSelect.value) {
                cargarMunicipios(departamentoSelect.value, municipioSeleccionado);
            }

            // Función para cargar los municipios del departamento
            function cargarMunicipios(departamentoId, municipioId = null) {
                if (departamentoId) {
                    fetch(`/municipios/${departamentoId}`)
                        .then(response => response.json())
                        .then(data => {
                            municipioSelect.innerHTML = '<option value="">Seleccione el municipio</option>';
                            data.forEach(municipio => {
                                const option = document.createElement('option');
                                option.value = municipio.municipio_id;
                                option.textContent = municipio.municipio;
                                municipioSelect.appendChild(option);
                            });

                            // Establecer el municipio seleccionado al cargar si se está editando
                            if (municipioId) {
                                municipioSelect.value = municipioId;
                            }
                        })
                        .catch(error => {
                            console.error('Error al cargar los municipios:', error);
                        });
                } else {
                    municipioSelect.innerHTML = '<option value="">Seleccione el municipio</option>';
                }
            }
        });
    </script>
@endsection
