@extends('layouts.app')

@section('style')
    <link href="{{ asset('assets/plugins/vectormap/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />

@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="form-section">
                <div class="form-header">
                    <a href="{{ route('dashboard') }}" class="back-button">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h3>Crear Nueva Primera Comunión</h3>
                    <p>Complete el formulario para registrar una nueva primera comunión</p>
                </div>

                <div class="form-body">
                    <form action="{{ route('comuniones.store') }}" method="POST">
                        @csrf

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-book"></i> Información del Registro
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="NoPartida" class="form-label required-field">No. Libro:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-ticket"></i>
                                        <input type="text" class="form-control" id="NoPartida" name="NoPartida"
                                            value="{{ old('NoPartida') }}" placeholder="Ej: 123-A">
                                    </div>
                                    @error('NoPartida')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="folio" class="form-label required-field">Folio:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-page"></i>
                                        <input type="text" class="form-control" id="folio" name="folio"
                                            value="{{ old('folio') }}" placeholder="Ej: 45">
                                    </div>
                                    @error('folio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="fecha_comunion" class="form-label required-field">Fecha de Comunión:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-calendar"></i>
                                        <input type="date" class="form-control" id="fecha_comunion" name="fecha_comunion"
                                            value="{{ old('fecha_comunion') }}">
                                    </div>
                                    @error('fecha_comunion')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-priest"></i> Información del Sacerdote
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="sacerdote_search" class="form-label required-field">Buscar
                                        Sacerdote:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="sacerdote_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI">
                                        </div>
                                        <input type="hidden" id="sacerdote_id" name="sacerdote_id"
                                            value="{{ old('sacerdote_id') }}">
                                        <div class="search-results">
                                            <select id="select_sacerdote" class="form-control" style="display: none;"
                                                size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('sacerdote_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-user"></i> Persona que recibe la Comunión
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="persona_comunion_search" class="form-label required-field">Buscar
                                        Persona:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="persona_comunion_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI (mínimo 3 caracteres)">
                                        </div>
                                        <input type="hidden" id="persona_participe_id" name="persona_participe_id"
                                            value="{{ old('persona_participe_id') }}">
                                        <div class="search-results">
                                            <select id="select_persona_comunion" class="form-control" style="display: none;"
                                                size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('persona_participe_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-users"></i> Datos de los Padres
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="padre_search" class="form-label">Padre:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-user"></i>
                                            <input type="text" id="padre_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI">
                                        </div>
                                        <input type="hidden" id="padre_id" name="padre_id" value="{{ old('padre_id') }}">
                                        <div class="search-results">
                                            <select id="select_padre" class="form-control" style="display: none;" size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('padre_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="madre_search" class="form-label">Madre:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-user"></i>
                                            <input type="text" id="madre_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI">
                                        </div>
                                        <input type="hidden" id="madre_id" name="madre_id" value="{{ old('madre_id') }}">
                                        <div class="search-results">
                                            <select id="select_madre" class="form-control" style="display: none;" size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('madre_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-map-marker"></i> Ubicación
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="departamento_id" class="form-label required-field">Departamento:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-map"></i>
                                        <select class="form-control" id="departamento_id" name="departamento_id">
                                            <option value="">Seleccione el departamento</option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{ $departamento->departamento_id }}" {{ old('departamento_id') == $departamento->departamento_id ? 'selected' : '' }}>
                                                    {{ $departamento->depto }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('departamento_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="municipio_id" class="form-label required-field">Municipio:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-pin"></i>
                                        <select class="form-control" id="municipio_id" name="municipio_id">
                                            <option value="">Seleccione el municipio</option>
                                            @foreach ($municipios as $municipio)
                                                <option value="{{ $municipio->municipio_id }}" {{ old('municipio_id') == $municipio->municipio_id ? 'selected' : '' }}>
                                                    {{ $municipio->municipio }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('municipio_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <div class="text-muted">
                            </div>
                            <button type="submit" class="submit-button">
                                <i class="lni lni-save"></i> Guardar Comunión
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        document.addEventListener("DOMContentLoaded", function () {
            const departamentoSelect = document.getElementById('departamento_id');
            const municipioSelect = document.getElementById('municipio_id');

            // Si ya hay un departamento seleccionado, cargar sus municipios
            if (departamentoSelect.value) {
                cargarMunicipios(departamentoSelect.value);
            }

            // Evento cuando se cambia el departamento
            departamentoSelect.addEventListener('change', function () {
                cargarMunicipios(this.value);
            });

            // Función para cargar municipios
            function cargarMunicipios(departamentoId) {
                // Mostrar indicador de carga
                municipioSelect.innerHTML = '<option value="">Cargando municipios...</option>';
                municipioSelect.disabled = true;

                if (departamentoId) {
                    fetch(`/municipios/${departamentoId}`)
                        .then(response => {
                            if (!response.ok) {
                                throw new Error('Error en la respuesta del servidor');
                            }
                            return response.json();
                        })
                        .then(data => {
                            municipioSelect.innerHTML = '<option value="">Seleccione el municipio</option>';
                            municipioSelect.disabled = false;

                            if (data && data.length > 0) {
                                data.forEach(municipio => {
                                    const option = document.createElement('option');
                                    option.value = municipio.municipio_id;
                                    option.textContent = municipio.municipio;
                                    option.selected = municipio.municipio_id == "{{ old('municipio_id') }}";
                                    municipioSelect.appendChild(option);
                                });
                            } else {
                                municipioSelect.innerHTML = '<option value="">No hay municipios disponibles</option>';
                            }
                        })
                        .catch(error => {
                            console.error('Error al obtener los municipios:', error);
                            municipioSelect.innerHTML = '<option value="">Error al cargar municipios</option>';
                            municipioSelect.disabled = false;
                        });
                } else {
                    municipioSelect.innerHTML = '<option value="">Seleccione el municipio</option>';
                    municipioSelect.disabled = false;
                }
            }

            // Configurar búsqueda para cada campo de persona
            setupPersonSearch('persona_comunion_search', 'persona_participe_id', 'select_persona_comunion', 'F');
            setupPersonSearch('padre_search', 'padre_id', 'select_padre', 'F', 'M');
            setupPersonSearch('madre_search', 'madre_id', 'select_madre', 'F', 'F');
            setupPersonSearch('sacerdote_search', 'sacerdote_id', 'select_sacerdote', 'S'); // 'S' para Sacerdote

            // Cargar datos de personas seleccionadas previamente
            cargarPersonasSeleccionadas();

            // Función para cargar personas seleccionadas previamente (cuando hay errores de validación)
            function cargarPersonasSeleccionadas() {
                const personaIds = {
                    'persona_participe_id': 'persona_comunion_search',
                    'padre_id': 'padre_search',
                    'madre_id': 'madre_search',
                    'sacerdote_id': 'sacerdote_search'
                };

                // Verificar cada campo de ID y cargar los datos si existe
                for (const [idField, searchField] of Object.entries(personaIds)) {
                    const hiddenInput = document.getElementById(idField);
                    const searchInput = document.getElementById(searchField);

                    if (hiddenInput && searchInput && hiddenInput.value) {
                        // Si hay un ID guardado, cargar los datos de la persona
                        fetch(`/api/personas/${hiddenInput.value}`)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Error al cargar datos de la persona');
                                }
                                return response.json();
                            })
                            .then(data => {
                                if (data) {
                                    // Mostrar el nombre completo en el campo de búsqueda
                                    searchInput.value = `${data.nombres} ${data.apellidos} - ${data.dpi_cui || 'Sin DPI'}`;
                                    searchInput.classList.add('is-valid');
                                }
                            })
                            .catch(error => {
                                console.error(`Error al cargar datos para ${idField}:`, error);
                            });
                    }
                }
            }

        });
    </script>
@endsection