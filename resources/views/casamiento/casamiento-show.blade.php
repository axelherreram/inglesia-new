@extends('layouts.app')

@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <style>
        .card {
            max-width: 800px;
            margin: auto;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-header bg-transparent">
                    <a href="{{ route('casamientos.index') }}" class="btn btn-sm btn-primary-ig-r">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h3 class="mt-3">Detalles de casamiento</h3>
                </div>
                <form action="{{ route('casamientos.update', $casamiento->casamiento_id) }}" method="POST" id="formGuardar"
                    class="p-4">
                    @csrf
                    @method('PUT') <!-- Importante: especifica que se trata de una actualización -->

                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <!-- Correlativo y Fecha del casamiento -->
                    <div class="row mb-3">
                        <div class="col-sm-3">
                            <label for="NoPartida" class="form-label">Partida No:</label>
                            <input type="text" class="form-control" id="NoPartida" name="NoPartida"
                                value="{{ old('NoPartida', $casamiento->NoPartida) }}">
                            @error('NoPartida')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-3">
                            <label for="folio" class="form-label">Folio:</label>
                            <input type="text" class="form-control" id="folio" name="folio"
                                value="{{ old('folio', $casamiento->folio) }}">
                            @error('folio')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="fecha_casamiento" class="form-label">Fecha de casamiento:</label>
                            <input type="date" class="form-control" id="fecha_casamiento" name="fecha_casamiento"
                                value="{{ old('fecha_casamiento', \Carbon\Carbon::parse($casamiento->fecha_casamiento)->format('Y-m-d')) }}">
                            @error('fecha_casamiento')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- nombres_testigos -->
                    <span><strong>Testigos</strong></span>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <textarea class="form-control" id="nombres_testigos" name="nombres_testigos" rows="3">{{ old('nombres_testigos', $casamiento->nombres_testigos) }}</textarea>
                            @error('nombres_testigos')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos del esposo -->
                    <span><strong>Datos del esposo</strong></span>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre_esposo" class="form-label">Nombre del esposo:</label>
                            <input type="text" class="form-control" id="nombre_esposo" name="nombre_esposo"
                                value="{{ old('nombre_esposo', $casamiento->nombre_esposo) }}">
                            @error('nombre_esposo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="edad_esposo" class="form-label">Edad del esposo:</label>
                            <input type="number" class="form-control" id="edad_esposo" name="edad_esposo" min="0"
                                value="{{ old('edad_esposo', $casamiento->edad_esposo) }}">
                            @error('edad_esposo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="origen_esposo" class="form-label">Origen del esposo:</label>
                            <input type="text" class="form-control" id="origen_esposo" name="origen_esposo"
                                value="{{ old('origen_esposo', $casamiento->origen_esposo) }}">
                            @error('origen_esposo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="feligresesposo" class="form-label">Feligres de:</label>
                            <input type="text" class="form-control" id="feligresesposo" name="feligresesposo"
                                value="{{ old('feligresia_esposo', $casamiento->feligresesposo) }}">
                            @error('feligresesposo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de los Padres del esposo -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre_padre_esposo" class="form-label">Nombre del padre:</label>
                            <input type="text" class="form-control" id="nombre_padre_esposo" name="nombre_padre_esposo"
                                value="{{ old('nombre_padre_esposo', $casamiento->nombre_padre_esposo) }}">
                            @error('nombre_padre_esposo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="nombre_madre_esposo" class="form-label">Nombre de la madre:</label>
                            <input type="text" class="form-control" id="nombre_madre_esposo"
                                name="nombre_madre_esposo"
                                value="{{ old('nombre_madre_esposo', $casamiento->nombre_madre_esposo) }}">
                            @error('nombre_madre_esposo')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de la esposa -->
                    <span><strong>Datos de la esposa</strong></span>
                    <hr>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre_esposa" class="form-label">Nombre de la esposa:</label>
                            <input type="text" class="form-control" id="nombre_esposa" name="nombre_esposa"
                                value="{{ old('nombre_esposa', $casamiento->nombre_esposa) }}">
                            @error('nombre_esposa')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="edad_esposa" class="form-label">Edad de la esposa:</label>
                            <input type="number" class="form-control" id="edad_esposa" name="edad_esposa"
                                min="0" value="{{ old('edad_esposa', $casamiento->edad_esposa) }}">
                            @error('edad_esposa')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="origen_esposa" class="form-label">Origen de la esposa:</label>
                            <input type="text" class="form-control" id="origen_esposa" name="origen_esposa"
                                value="{{ old('origen_esposa', $casamiento->origen_esposa) }}">
                            @error('origen_esposa')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="feligresesposa" class="form-label">Feligres de:</label>
                            <input type="text" class="form-control" id="feligresesposa" name="feligresesposa"
                                value="{{ old('feligresesposa', $casamiento->feligresesposa) }}">
                            @error('feligresesposa')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Datos de los Padres de la esposa -->
                    <div class="row mb-3">
                        <div class="col-sm-6">
                            <label for="nombre_padre_esposa" class="form-label">Nombre del padre:</label>
                            <input type="text" class="form-control" id="nombre_padre_esposa"
                                name="nombre_padre_esposa"
                                value="{{ old('nombre_padre_esposa', $casamiento->nombre_padre_esposa) }}">
                            @error('nombre_padre_esposa')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="col-sm-6">
                            <label for="nombre_madre_esposa" class="form-label">Nombre de la madre:</label>
                            <input type="text" class="form-control" id="nombre_madre_esposa"
                                name="nombre_madre_esposa"
                                value="{{ old('nombre_madre_esposa', $casamiento->nombre_madre_esposa) }}">
                            @error('nombre_madre_esposa')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Parroco -->
                    <span><strong>Párroco</strong></span>
                    <div class="row mb-3">
                        <div class="col-sm-12">
                            <input class="form-control" id="nombre_parroco" name="nombre_parroco"
                                value="{{ old('nombre_parroco', $casamiento->nombre_parroco) }}">
                            @error('nombre_parroco')
                                <div class="text-danger">{{ $message }}</div>
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
                            <button type="button" class="btn btn-secondary w-100 w-md-50" onclick="window.open('{{ route('casamiento.pdf', $casamiento->casamiento_id) }}', '_blank')">Imprimir a PDF</button>
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
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('formGuardar').submit(); 
                }
            });
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
