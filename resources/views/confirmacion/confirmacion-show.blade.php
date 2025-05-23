@extends('layouts.app')

@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <style>
        .card {
            max-width: 800px;
            margin: auto;
        }

        .error-message {
            color: red;
            font-size: 0.875em;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-header bg-transparent">
                    <a href="{{ route('confirmaciones.index') }}" class="btn btn-sm btn-primary-ig-r">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h3 class="mt-3">Detalles de la Confirmación</h3>
                </div>

                <form action="{{ route('confirmaciones.update', $confirmacion->confirmacion_id) }}" method="POST"
                    class="p-4" id="formGuardar">
                    @csrf
                    @method('PUT')  
                        <div class="row mb-3">
                            <div class="col-sm-3">
                                <label for="NoPartida" class="form-label">Partida No:</label>
                                <input type="text" class="form-control" id="NoPartida" name="NoPartida"
                                    value="{{ old('NoPartida', $confirmacion->NoPartida) }}">
                                @error('NoPartida')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-3">
                                <label for="folio" class="form-label">Folio:</label>
                                <input type="text" class="form-control" id="folio" name="folio"
                                    value="{{ old('folio', $confirmacion->folio) }}">
                                @error('folio')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="col-sm-6">
                                <label for="fecha_confirmacion" class="form-label">Fecha de Confirmación:</label>
                                <input type="date" class="form-control" id="fecha_confirmacion" name="fecha_confirmacion"
                                    value="{{ old('fecha_confirmacion', $confirmacion->fecha_confirmacion ? \Carbon\Carbon::parse($confirmacion->fecha_confirmacion)->format('Y-m-d') : '') }}">
                                @error('fecha_confirmacion')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Sacerdote -->
                        <div class="row mb-3">
                            <label for="nombre_persona_confirmo" class="col-sm-3 col-form-label">Monseñor (ó
                                delegado):</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nombre_persona_confirmo"
                                    name="nombre_persona_confirmo"
                                    value="{{ old('nombre_persona_confirmo', $confirmacion->nombre_persona_confirmo) }}">
                                @error('nombre_persona_confirmo')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Persona confirmada -->
                        <div class="row mb-3">
                            <label for="nombre_persona_confirmada" class="col-sm-3 col-form-label">Nombre de la persona
                                confirmada:</label>
                            <div class="col-sm-9">
                                <input type="text" class="form-control" id="nombre_persona_confirmada"
                                    name="nombre_persona_confirmada"
                                    value="{{ old('nombre_persona_confirmada', $confirmacion->nombre_persona_confirmada) }}">
                                @error('nombre_persona_confirmada')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <div class="row mb-3">
                            <div class="col-sm-2">
                                <label for="edad" class="form-label">Edad:</label>
                                <input type="number" class="form-control" id="edad" name="edad"
                                    value="{{ old('edad', $confirmacion->edad) }}">
                                @error('edad')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-10">
                                <label for="nombre_parroquia_bautizo" class="form-label">Bautizada en la Parroquía:</label>
                                <input type="text" class="form-control" id="nombre_parroquia_bautizo"
                                    name="nombre_parroquia_bautizo"
                                    value="{{ old('nombre_parroquia_bautizo', $confirmacion->nombre_parroquia_bautizo) }}">
                                @error('nombre_parroquia_bautizo')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Información padres -->
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="nombre_padre" class="form-label">Nombre del padre:</label>
                                <input type="text" class="form-control" id="nombre_padre" name="nombre_padre"
                                    value="{{ old('nombre_padre', $confirmacion->nombre_padre) }}">
                                @error('nombre_padre')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="nombre_madre" class="form-label">Nombre de la madre:</label>
                                <input type="text" class="form-control" id="nombre_madre" name="nombre_madre"
                                    value="{{ old('nombre_madre', $confirmacion->nombre_madre) }}">
                                @error('nombre_madre')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Datos padrinos -->
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="nombre_persona_padrino" class="form-label">Nombre del padrino:</label>
                                <input type="text" class="form-control" id="nombre_persona_padrino"
                                    name="nombre_persona_padrino"
                                    value="{{ old('nombre_persona_padrino', $confirmacion->nombre_persona_padrino) }}">
                                @error('nombre_persona_padrino')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="nombre_persona_madrina" class="form-label">Nombre de la madrina:</label>
                                <input type="text" class="form-control" id="nombre_persona_madrina"
                                    name="nombre_persona_madrina"
                                    value="{{ old('nombre_persona_madrina', $confirmacion->nombre_persona_madrina) }}">
                                @error('nombre_persona_madrina')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Ubicación -->
                        <div class="row mb-3">
                            <div class="col-sm-6">
                                <label for="departamento_id" class="form-label">Departamento:</label>
                                <select class="form-control" id="departamento_id" name="departamento_id">
                                    <option value="">Seleccione el departamento</option>
                                    @foreach ($departamentos as $departamento)
                                        <option value="{{ $departamento->departamento_id }}"
                                            {{ old('departamento_id', $confirmacion->departamento_id) == $departamento->departamento_id ? 'selected' : '' }}>
                                            {{ $departamento->depto }}
                                        </option>
                                    @endforeach
                                </select>
                                @error('departamento_id')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                            <div class="col-sm-6">
                                <label for="municipio_id" class="form-label">Municipio:</label>
                                <select class="form-control" id="municipio_id" name="municipio_id">
                                    <option value="">Seleccione el municipio</option>
                                </select>
                                @error('municipio_id')
                                    <p class="error-message">{{ $message }}</p>
                                @enderror
                            </div>
                        </div>

                        <!-- Botón de Guardar y Imprimir a PDF -->
                        <div class="row mt-3">
                            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-end mb-2 mb-md-0">
                                <button type="button" class="btn btn-primary-ig w-100 w-md-50 me-md-2"
                                    id="btnGuardar">Guardar cambios</button>
                            </div>
                            <div class="col-12 col-md-6 d-flex justify-content-center justify-content-md-start">
                                <button type="button" class="btn btn-secondary w-100 w-md-50" onclick="window.open('{{ route('confirmacion.pdf', $confirmacion->confirmacion_id) }}', '_blank')">Imprimir a PDF</button>
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
                cancelButtonColor: 'red',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formGuardar').submit(); 
                }
            });
        });
        document.getElementById('departamento_id').addEventListener('change', function() {
            const departamentoId = this.value;
            const municipioSelect = document.getElementById('municipio_id');

            // Limpiar el selector de municipios
            municipioSelect.innerHTML = '<option value="">Seleccione el municipio</option>';

            if (departamentoId) {
                // Realizar la petición AJAX para obtener los municipios
                fetch(`/municipios/${departamentoId}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(municipio => {
                            const option = document.createElement('option');
                            option.value = municipio.municipio_id;
                            option.textContent = municipio.municipio;
                            municipioSelect.appendChild(option);
                        });

                        const selectedMunicipio = "{{ old('municipio_id', $confirmacion->municipio_id) }}";
                        if (selectedMunicipio) {
                            municipioSelect.value = selectedMunicipio;
                        }
                    })
                    .catch(error => {
                        console.error('Error al obtener los municipios:', error);
                    });
            }
        });

        // Cargar municipios al cargar la página si ya hay un departamento seleccionado
        document.addEventListener('DOMContentLoaded', function() {
            const departamentoId = document.getElementById('departamento_id').value;
            if (departamentoId) {
                document.getElementById('departamento_id').dispatchEvent(new Event('change'));
            }
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
