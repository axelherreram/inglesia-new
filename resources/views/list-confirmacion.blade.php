@extends('layouts.app')

@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <style>
        p.small.text-muted {
            display: none
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="card radius-10">
                <div class="card-header bg-transparent">
                    <a href="{{ route('dashboard') }}" class="btn btn-sm btn-primary-ig-r">
                        <i class="font-22 lni lni-arrow-left"></i>
                        Regresar
                    </a>
                    <h2 class="mt-3">Listado de Confirmaciones</h2>
                    <hr>
                    <div class="row g-3 align-items-center">
                        <form action="{{ route('confirmaciones.index') }}" method="GET"
                            class="row g-3 align-items-center  justify-content-center">
                            <p class="fs-6 fs-md-5 fs-lg-4" style="margin-bottom: 0px;">Búsqueda de confirmación por nombre y año de confirmación</p>
                            <div class="col-md-6 d-md-flex">
                                <div class="me-2 flex-fill">
                                    <input type="text" class="form-control" id="nombre" name="nombre"
                                        placeholder="Nombre de persona" value="{{ request('nombre') }}">
                                </div>
                            </div>

                            <!-- Input de fecha en su propia columna -->
                            <div class="col-md-3">
                                <input type="number" class="form-control" id="fecha_confirmacion" name="fecha_confirmacion"
                                    placeholder="2024" min="1900" max="2200" value="{{ request('fecha_confirmacion') }}">
                            </div>

                            <!-- Botón de Buscar -->
                            <div class="col-md-3">
                                <button class="btn btn-primary-ig  w-100">Buscar</button>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="card-body text-center">
                    <div class="table-responsive">
                        <table class="table align-middle mb-0 mx-auto">
                            <thead class="table-light">
                                <tr>
                                    <th>Correlativo</th>
                                    <th>Persona Confirmada</th>
                                    <th>Sacerdote</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($confirmaciones as $confirmacion)
                                    <tr>
                                        <td>{{ $confirmacion->NoPartida }} - {{ $confirmacion->folio }}</td>
                                        <td>{{ $confirmacion->nombre_persona_confirmada }}</td>
                                        <td>{{ $confirmacion->nombre_persona_confirmo }}</td>
                                        <td>{{ \Carbon\Carbon::parse($confirmacion->fecha_confirmacion)->format('Y-m-d') }}
                                        </td>
                                        <td><a href="{{ route('confirmaciones.show', $confirmacion->confirmacion_id) }}"
                                                class="btn btn-primary-ig btn-sm">Visualizar</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="font-weight: bold"
                                            class="text-center font-weight-bold fs-6 p-2 mt-3 d-block d-md-table-cell">
                                            No se encontraron registros de confirmaciones con los datos especificados.
                                        </td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>

                <!-- Paginación -->
                <div class="pagination-container">
                    <div class="d-flex justify-content-center mt-4">
                        {{ $confirmaciones->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@section('script')
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
        @if (session('no_results'))
            Swal.fire({
                icon: 'info',
                title: 'Sin resultados',
                text: '{{ session('no_results') }}',
                showConfirmButton: true,
                confirmButtonText: 'Aceptar'
            });
        @endif
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
