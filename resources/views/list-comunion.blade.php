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
                    <a href="dashboard" class="btn btn-sm btn-primary-ig-r">
                        <i class="font-22 lni lni-arrow-left"></i>
                        Regresar
                    </a>
                    <h2 class="mt-3">Listado de Comunión</h2>
                    <hr>
                    <div class="row g-3 align-items-center">
                        <form action="{{ route('comuniones.index') }}" method="GET"
                            class="row g-3 align-items-center  justify-content-center">
                            <p class="fs-6 fs-md-5 fs-lg-4" style="margin-bottom: 0px;">Búsqueda de comunión por nombre y año de comunión</p>
                            <div class="col-md-6 d-md-flex">
                                <div class="me-2 flex-fill">
                                    <input type="text" class="form-control" id="search" name="search"
                                        placeholder="Nombre de persona" value="{{ request('search') }}">
                                </div>

                            </div>
                            <div class="col-md-3">
                                <input type="number" class="form-control" id="year" name="year" placeholder="2024"
                                    min="1900" max="2200" value="{{ request('year') }}">
                            </div>
                            <!-- Botón de Buscar -->
                            <div class="col-md-3">
                                <button class="btn btn-primary-ig w-100">Buscar</button>
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
                                    <th>Persona Primera Comunión</th>
                                    <th>Fecha</th>
                                    <th>Acción</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($comuniones as $comunion)
                                    <tr>
                                        <td>{{ $comunion->NoPartida }} - {{ $comunion->folio }}</td>
                                        <td>{{ $comunion->nombre_persona_participe }}</td>
                                        <td>{{ \Carbon\Carbon::parse($comunion->fecha_comunion)->format('Y-m-d') }}</td>
                                        <td><a href="{{ route('comuniones.show', $comunion->comunion_id) }}"
                                                class="btn btn-primary-ig btn-sm">Visualizar</a></td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" style="font-weight: bold"
                                            class="text-center font-weight-bold fs-6 p-2 mt-3 d-block d-md-table-cell">
                                            No se encontraron registros de comuniones con los datos especificados.
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
                        {{ $comuniones->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

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
