@extends('layouts.app')

@section('style')
    <style>
        /* Formulario */
        .search-section {
            padding: 20px 25px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #eee;
            display: flex;
            gap: 15px;
            align-items: center;
        }

        .search-input,
        .filter-select {
            width: 100%;
            padding: 10px 15px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 0.95rem;
            transition: all 0.2s ease;
        }

        .search-input:focus,
        .filter-select:focus {
            border-color: #4a6cf7;
            box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.2);
            outline: none;
        }

        .search-input {
            max-width: 300px;
        }

        .filter-select {
            max-width: 200px;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="personas-card">
                <div class="card-header p-4">
                    <a href="/" class="back-button">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h2 class="page-title" style="color: white">Listado de Personas</h2>
                    <div></div> <!-- Empty div for flex spacing -->
                </div>

                <form action="{{ route('personas.index') }}" method="GET" class="p-3">
                    <h5>Buscar personas por CUI, nombre, apellido y filtrado por tipo de persona</h5>
                    <div class="search-section">
                        <input type="text" name="search" class="search-input"
                            placeholder="Buscar persona por nombre, apellido o DPI..." value="{{ request('search') }}">
                        <select class="filter-select" name="tipo_persona" id="tipo_persona">
                            <option value="">Seleccionar Tipo de Persona</option>
                            <option value="F" {{ request('tipo_persona') == 'F' ? 'selected' : '' }}>Feligrés</option>
                            <option value="S" {{ request('tipo_persona') == 'S' ? 'selected' : '' }}>Sacerdote</option>
                            <option value="O" {{ request('tipo_persona') == 'O' ? 'selected' : '' }}>Obispo</option>
                        </select>
                        <button type="submit" class="btn btn-primary">Buscar</button>
                    </div>
                </form>


                <div class="table-container">
                    @if(count($personas) > 0)
                        <div class="table-responsive">
                            <table class="personas-table">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>DPI/CUI</th>
                                        <th>Municipio</th>
                                        <th class="text-center">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($personas as $persona)
                                        <tr>
                                            <td>{{ $persona->nombres }}</td>
                                            <td>{{ $persona->apellidos }}</td>
                                            <td>{{ $persona->dpi_cui }}</td>
                                            <td>{{ $persona->municipio->municipio }}</td>
                                            <td>
                                                <div class="action-buttons">
                                                    <a href="{{ route('personas.show', $persona->persona_id) }}" class="btn-view">
                                                        <i class="lni lni-eye"></i> Ver
                                                    </a>
                                                    <a href="{{ route('personas.edit', $persona->persona_id) }}" class="btn-edit">
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
                            <p class="empty-state-text">No hay personas registradas en el sistema.</p>
                        </div>
                    @endif
                </div>

                @if(isset($personas) && method_exists($personas, 'links'))
                    <div class="pagination-container">
                        {{ $personas->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
@endsection