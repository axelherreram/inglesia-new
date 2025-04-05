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
                    <a href="{{ route('comuniones.index') }}" class="btn btn-sm btn-primary-ig-r">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h3 class="mt-3">Detalles de la Primera Comunión</h3>
                </div>

                <form action="{{ route('comuniones.update', $comunion->comunion_id) }}" method="POST" id="formGuardar"
                    class="p-4">
                    @csrf
                    @method('PUT') <!-- Esto es importante para indicar que es una actualización -->

                    <!-- Correlativo y Fecha de Comunión -->
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="NoPartida" class="form-label">Partida No:</label>
                            <input type="text" class="form-control" id="NoPartida" name="NoPartida"
                                value="{{ old('NoPartida', $comunion->NoPartida) }}">
                            @error('NoPartida')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="folio" class="form-label">Folio:</label>
                            <input type="text" class="form-control" id="folio" name="folio"
                                value="{{ old('folio', $comunion->folio) }}">
                            @error('folio')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>

                        <div class="col-sm-6">
                            <label for="fecha_comunion" class="form-label">Fecha de Comunión:</label>
                            <input type="date" class="form-control" id="fecha_comunion" name="fecha_comunion"
                                value="{{ old('fecha_comunion', $comunion->fecha_comunion ? \Carbon\Carbon::parse($comunion->fecha_comunion)->format('Y-m-d') : '') }}">
                            @error('fecha_comunion')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de la persona de la comunión -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="nombre_persona_participe" class="form-label">Nombre de la persona de la primera
                                comunión:</label>
                            <input type="text" class="form-control" id="nombre_persona_participe"
                                name="nombre_persona_participe"
                                value="{{ old('nombre_persona_participe', $comunion->nombre_persona_participe) }}">
                            @error('nombre_persona_participe')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Fecha de nacimiento -->
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <label for="fecha_nacimiento" class="form-label">Fecha de nacimiento:</label>
                            <input type="date" class="form-control" id="fecha_nacimiento" name="fecha_nacimiento"
                                value="{{ old('fecha_nacimiento', $comunion->fecha_nacimiento ? \Carbon\Carbon::parse($comunion->fecha_nacimiento)->format('Y-m-d') : '') }}">
                            @error('fecha_nacimiento')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de los Padres -->
                    <span><strong>Datos de los padres</strong></span>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre_padre" class="form-label">Nombre del padre:</label>
                            <input type="text" class="form-control" id="nombre_padre" name="nombre_padre"
                                value="{{ old('nombre_padre', $comunion->nombre_padre) }}">
                            @error('nombre_padre')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="nombre_madre" class="form-label">Nombre de la madre:</label>
                            <input type="text" class="form-control" id="nombre_madre" name="nombre_madre"
                                value="{{ old('nombre_madre', $comunion->nombre_madre) }}">
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
                                    <option value="{{ $departamento->departamento_id }}"
                                        {{ old('departamento_id', $comunion->departamento_id) == $departamento->departamento_id ? 'selected' : '' }}>
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
                            </select>
                            @error('municipio_id')
                                <span class="text-danger">{{ $message }}</span>
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
                            <button type="button" class="btn btn-secondary w-100 w-md-50" onclick="window.open('{{ route('comunion.pdf', $comunion->comunion_id) }}', '_blank')">Imprimir a PDF</button>
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
        // Confirmación con SweetAlert al intentar guardar los cambios
        document.getElementById('btnGuardar').addEventListener('click', function(e) {
            e.preventDefault(); 


            Swal.fire({
                title: '¿Estás seguro?',
                text: "Se guardarán los cambios del registro.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: 'red',
                confirmButtonText: 'Sí, guardar',
                cancelButtonText: 'Cancelar',
                customClass: {
                    cancelButton: 'cancel-custom' 
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formGuardar').submit(); 
                }
            });
        });

        // Manejo de cambio de departamento y carga de municipios
        document.getElementById('departamento_id').addEventListener('change', function() {
            const departamentoId = this.value;
            const municipioSelect = document.getElementById('municipio_id');

            // Limpiar el selector de municipios
            municipioSelect.innerHTML = '<option value="">Seleccione municipio</option>';

            if (departamentoId) {
                // Realizar la petición AJAX para obtener los municipios
                fetch(`/municipios/${departamentoId}`)
                    .then(response => response.json())
                    .then(data => {
                        // Agregar los municipios al select de municipios
                        data.forEach(municipio => {
                            const option = document.createElement('option');
                            option.value = municipio.municipio_id;
                            option.textContent = municipio.municipio;
                            municipioSelect.appendChild(option);
                        });

                        // Si hay un municipio seleccionado
                        const selectedMunicipio = "{{ old('municipio_id', $comunion->municipio_id) }}";
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
    <script src="assets/plugins/raphael/raphael-min.js"></script>
    <script src="assets/plugins/morris/js/morris.js"></script>
    <script src="assets/js/index2.js"></script>
@endsection
