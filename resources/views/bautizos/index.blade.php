@extends('layouts.app')

@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="personas-card">
                <div class="card-header p-4">
                    <a href="dashboard" class="back-button">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h2 class="page-title" style="color: white">Listado de Bautizos</h2>
                </div>
                <div class="search-section">
                    <h5>Buscar Bautizo:</h5>
                    <form action="{{ route('bautizos.index') }}" method="GET">
                        <div class="row g-3">
                            <div class="col-md-4">
                                <input type="text" class="search-input" name="search" placeholder="Nombre completo o CUI"
                                    value="{{ request('search') }}">
                            </div>
                            <div class="col-md-2">
                                <button type="submit" class="btn btn-primary w-100">Buscar</button>
                            </div>
                        </div>
                    </form>
                </div>



                <div class="table-container">
                    @if(count($bautizos) > 0)
                        <div class="table-responsive">
                            <table class="personas-table">
                                <thead>
                                    <tr>
                                        <th>Correlativo</th>
                                        <th>Persona Bautizada</th>
                                        <th>Sacerdote</th>
                                        <th>Fecha Bautizo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($bautizos as $bautizo)
                                        <tr>
                                            <td>{{ $bautizo->NoPartida }} - {{ $bautizo->folio }}</td>
                                            <td>{{ $bautizo->personaBautizada->nombres }}
                                                {{ $bautizo->personaBautizada->apellidos }}
                                            </td>
                                            <td>{{ $bautizo->sacerdote->nombres }} {{ $bautizo->sacerdote->apellidos }}</td>
                                            <td>{{ \Carbon\Carbon::parse($bautizo->fecha_bautizo)->format('Y-m-d') }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('bautizos.show', $bautizo->bautizo_id) }}" class="btn-view">
                                                        <i class="lni lni-eye"></i> Ver
                                                    </a>
                                                    <a href="{{ route('bautizos.edit', $bautizo->bautizo_id) }}" class="btn-edit">
                                                        <i class="lni lni-pencil"></i> Editar
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="empty-state">
                            <div class="empty-state-icon">
                                <i class="lni lni-users"></i>
                            </div>
                            <p class="empty-state-text">No se encontraron registros de bautizos.</p>
                        </div>
                    @endif
                </div>

                <div class="pagination-container">
                    <div class="d-flex justify-content-center mt-4">
                        {{ $bautizos->onEachSide(1)->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- SweetAlert2 -->
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