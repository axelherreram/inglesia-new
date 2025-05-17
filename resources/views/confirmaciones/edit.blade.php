@extends('layouts.app')



@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="persona-card">
            <div class="form-header">
                <div class="header-content">
                    <a href="{{ route('confirmaciones.index') }}" class="back-button">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                </div>
                <h2 class="persona-title mt-4" style="color: white">Editar Registro de Confirmación</h2>
                <p class="persona-subtitle">Partida: {{ $confirmacion->NoPartida }} • Folio: {{ $confirmacion->folio }}</p>
            </div>

            <div class="info-section">
                <form id="edit-form" action="{{ route('confirmaciones.update', $confirmacion->confirmacion_id) }}" method="POST">
                    @csrf
                    @method('PUT')
                    
                    <h3 class="section-title">Información de la Confirmación</h3>
                    <div class="row">
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="NoPartida" class="form-label required-field">Partida No:</label>
                                <div class="input-icon">
                                    <i class="lni lni-ticket"></i>
                                    <input type="text" class="form-control" id="NoPartida" name="NoPartida" 
                                        value="{{ old('NoPartida', $confirmacion->NoPartida) }}">
                                </div>
                                @error('NoPartida')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="folio" class="form-label required-field">Folio:</label>
                                <div class="input-icon">
                                    <i class="lni lni-page"></i>
                                    <input type="text" class="form-control" id="folio" name="folio" 
                                        value="{{ old('folio', $confirmacion->folio) }}">
                                </div>
                                @error('folio')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="form-group">
                                <label for="fecha_confirmacion" class="form-label required-field">Fecha de Confirmación:</label>
                                <div class="input-icon">
                                    <i class="lni lni-calendar"></i>
                                    <input type="date" class="form-control" id="fecha_confirmacion" name="fecha_confirmacion" 
                                        value="{{ old('fecha_confirmacion', $confirmacion->fecha_confirmacion ? \Carbon\Carbon::parse($confirmacion->fecha_confirmacion)->format('Y-m-d') : '') }}">
                                </div>
                                @error('fecha_confirmacion')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>
                    
                    <h3 class="section-title">Sacerdote</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="sacerdote_search" class="form-label required-field">Sacerdote:</label>
                                <div class="search-container">
                                    <div class="input-icon">
                                        <i class="lni lni-crown"></i>
                                        <input type="text" id="sacerdote_search" class="form-control"
                                            placeholder="Escribe el nombre, apellido o DPI" 
                                            value="{{ $confirmacion->sacerdote ? $confirmacion->sacerdote->nombres . ' ' . $confirmacion->sacerdote->apellidos . ' - ' . ($confirmacion->sacerdote->dpi_cui ?: 'Sin DPI') : '' }}">
                                    </div>
                                    <input type="hidden" id="sacerdote_id" name="sacerdote_id" 
                                        value="{{ old('sacerdote_id', $confirmacion->sacerdote_id) }}">
                                    <div class="search-results">
                                        <select id="select_sacerdote" class="form-control" style="display: none;" size="5">
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

                    <div class="section-divider"></div>
                    
                    <h3 class="section-title">Persona Confirmada</h3>
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="persona_confirmada_search" class="form-label required-field">Buscar Persona:</label>
                                <div class="search-container">
                                    <div class="input-icon">
                                        <i class="lni lni-search"></i>
                                        <input type="text" id="persona_confirmada_search" class="form-control"
                                            placeholder="Escribe el nombre, apellido o DPI" 
                                            value="{{ $confirmacion->personaConfirmada ? $confirmacion->personaConfirmada->nombres . ' ' . $confirmacion->personaConfirmada->apellidos . ' - ' . ($confirmacion->personaConfirmada->dpi_cui ?: 'Sin DPI') : '' }}">
                                    </div>
                                    <input type="hidden" id="persona_confirmada_id" name="persona_confirmada_id" 
                                        value="{{ old('persona_confirmada_id', $confirmacion->persona_confirmada_id) }}">
                                    <div class="search-results">
                                        <select id="select_persona_confirmada" class="form-control" style="display: none;" size="5">
                                            <!-- Opciones se llenarán con JavaScript -->
                                        </select>
                                    </div>
                                </div>
                                @error('persona_confirmada_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                       
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="nombre_parroquia_bautizo" class="form-label">Bautizada en la Parroquia:</label>
                                <div class="input-icon">
                                    <i class="lni lni-church"></i>
                                    <input type="text" class="form-control" id="nombre_parroquia_bautizo" name="nombre_parroquia_bautizo"
                                        value="{{ old('nombre_parroquia_bautizo', $confirmacion->nombre_parroquia_bautizo) }}" placeholder="Nombre de la parroquia donde se bautizó">
                                </div>
                                @error('nombre_parroquia_bautizo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>
                    
                    <h3 class="section-title">Padres</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="padre_search" class="form-label">Padre:</label>
                                <div class="search-container">
                                    <div class="input-icon">
                                        <i class="lni lni-user"></i>
                                        <input type="text" id="padre_search" class="form-control"
                                            placeholder="Escribe el nombre, apellido o DPI" 
                                            value="{{ $confirmacion->padre ? $confirmacion->padre->nombres . ' ' . $confirmacion->padre->apellidos . ' - ' . ($confirmacion->padre->dpi_cui ?: 'Sin DPI') : '' }}">
                                    </div>
                                    <input type="hidden" id="padre_id" name="padre_id" 
                                        value="{{ old('padre_id', $confirmacion->padre_id) }}">
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
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="madre_search" class="form-label">Madre:</label>
                                <div class="search-container">
                                    <div class="input-icon">
                                        <i class="lni lni-user"></i>
                                        <input type="text" id="madre_search" class="form-control"
                                            placeholder="Escribe el nombre, apellido o DPI" 
                                            value="{{ $confirmacion->madre ? $confirmacion->madre->nombres . ' ' . $confirmacion->madre->apellidos . ' - ' . ($confirmacion->madre->dpi_cui ?: 'Sin DPI') : '' }}">
                                    </div>
                                    <input type="hidden" id="madre_id" name="madre_id" 
                                        value="{{ old('madre_id', $confirmacion->madre_id) }}">
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

                    <div class="section-divider"></div>
                    
                    <h3 class="section-title">Padrinos</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="padrino_search" class="form-label">Padrino:</label>
                                <div class="search-container">
                                    <div class="input-icon">
                                        <i class="lni lni-user"></i>
                                        <input type="text" id="padrino_search" class="form-control"
                                            placeholder="Escribe el nombre, apellido o DPI" 
                                            value="{{ $confirmacion->padrino ? $confirmacion->padrino->nombres . ' ' . $confirmacion->padrino->apellidos . ' - ' . ($confirmacion->padrino->dpi_cui ?: 'Sin DPI') : '' }}">
                                    </div>
                                    <input type="hidden" id="padrino_id" name="padrino_id" 
                                        value="{{ old('padrino_id', $confirmacion->padrino_id) }}">
                                    <div class="search-results">
                                        <select id="select_padrino" class="form-control" style="display: none;" size="5">
                                            <!-- Opciones se llenarán con JavaScript -->
                                        </select>
                                    </div>
                                </div>
                                @error('padrino_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="madrina_search" class="form-label">Madrina:</label>
                                <div class="search-container">
                                    <div class="input-icon">
                                        <i class="lni lni-user"></i>
                                        <input type="text" id="madrina_search" class="form-control"
                                            placeholder="Escribe el nombre, apellido o DPI" 
                                            value="{{ $confirmacion->madrina ? $confirmacion->madrina->nombres . ' ' . $confirmacion->madrina->apellidos . ' - ' . ($confirmacion->madrina->dpi_cui ?: 'Sin DPI') : '' }}">
                                    </div>
                                    <input type="hidden" id="madrina_id" name="madrina_id" 
                                        value="{{ old('madrina_id', $confirmacion->madrina_id) }}">
                                    <div class="search-results">
                                        <select id="select_madrina" class="form-control" style="display: none;" size="5">
                                            <!-- Opciones se llenarán con JavaScript -->
                                        </select>
                                    </div>
                                </div>
                                @error('madrina_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>
                    
                    <h3 class="section-title">Ubicación</h3>
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="departamento_id" class="form-label required-field">Departamento:</label>
                                <div class="input-icon">
                                    <i class="lni lni-map"></i>
                                    <select class="form-control" id="departamento_id" name="departamento_id">
                                        <option value="">Seleccione el departamento</option>
                                        @foreach($departamentos as $departamento)
                                            <option value="{{ $departamento->departamento_id }}" 
                                                {{ old('departamento_id', $confirmacion->departamento_id) == $departamento->departamento_id ? 'selected' : '' }}>
                                                {{ $departamento->depto }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                @error('departamento_id')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipio_id" class="form-label required-field">Municipio:</label>
                                <div class="input-icon">
                                    <i class="lni lni-pin"></i>
                                    <select class="form-control" id="municipio_id" name="municipio_id">
                                        <option value="">Seleccione el municipio</option>
                                        @foreach($municipios as $municipio)
                                            <option value="{{ $municipio->municipio_id }}" 
                                                {{ old('municipio_id', $confirmacion->municipio_id) == $municipio->municipio_id ? 'selected' : '' }}>
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

                    <!-- Botones de acción -->
                    <div class="action-buttons">
                        <a href="{{ route('confirmaciones.show', $confirmacion->confirmacion_id) }}" class="cancel-button">
                            <i class="lni lni-close"></i> Cancelar
                        </a>
                        <button type="button" id="submit-btn" class="save-button">
                            <i class="lni lni-save"></i> Guardar Cambios
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@section('script')
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        // Configuración del botón de envío con confirmación
        const submitBtn = document.getElementById('submit-btn');
        const form = document.getElementById('edit-form');
        
        submitBtn.addEventListener('click', function() {
            Swal.fire({
                title: '¿Está seguro de guardar los cambios?',
                text: "Esta acción actualizará el registro de la confirmación",
                icon: 'question',
                showCancelButton: true,
                confirmButtonColor: '#4a6cf7',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Sí, guardar cambios',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                }
            });
        });

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
                                option.selected = municipio.municipio_id == "{{ old('municipio_id', $confirmacion->municipio_id) }}";
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
        setupPersonSearch('persona_confirmada_search', 'persona_confirmada_id', 'select_persona_confirmada', 'F'); // Feligrés por defecto
        setupPersonSearch('padre_search', 'padre_id', 'select_padre', 'F'); // Feligrés por defecto
        setupPersonSearch('madre_search', 'madre_id', 'select_madre', 'F'); // Feligrés por defecto
        setupPersonSearch('padrino_search', 'padrino_id', 'select_padrino', 'F'); // Feligrés por defecto
        setupPersonSearch('madrina_search', 'madrina_id', 'select_madrina', 'F'); // Feligrés por defecto
        setupPersonSearch('sacerdote_search', 'sacerdote_id', 'select_sacerdote', 'S'); // Sacerdote

        // Función para configurar la búsqueda de personas
        function setupPersonSearch(searchInputId, hiddenInputId, selectId, tipo = null) {
            const searchInput = document.getElementById(searchInputId);
            const hiddenInput = document.getElementById(hiddenInputId);
            const selectElement = document.getElementById(selectId);

            if (!searchInput || !hiddenInput || !selectElement) {
                console.error(`Elementos no encontrados para: ${searchInputId}`);
                return;
            }

            // Función para mostrar un mensaje de carga
            function showLoading() {
                selectElement.innerHTML = '<option>Buscando...</option>';
                selectElement.style.display = 'block';
            }

            // Función para ocultar el selector
            function hideSelect() {
                selectElement.style.display = 'none';
            }

            // Variable para controlar el tiempo de espera
            let typingTimer;
            const doneTypingInterval = 500; // Tiempo en ms

            // Evento cuando se escribe en el campo de búsqueda
            searchInput.addEventListener('input', function() {
                const searchValue = this.value;
                
                // Limpiar el temporizador anterior
                clearTimeout(typingTimer);
                
                if (searchValue.length > 2) {
                    // Mostrar indicador de carga
                    showLoading();
                    
                    // Configurar un nuevo temporizador
                    typingTimer = setTimeout(() => {
                        let url = `/api/personas/buscar?search=${searchValue}`;
                        
                        // Agregar el tipo de persona si está definido
                        if (tipo) {
                            url += `&tipo=${tipo}`;
                        }
                        
                        fetch(url)
                            .then(response => {
                                if (!response.ok) {
                                    throw new Error('Error en la respuesta del servidor');
                                }
                                return response.json();
                            })
                            .then(data => {
                                selectElement.innerHTML = ''; // Limpiar opciones previas
                                
                                if (data.data && data.data.length > 0) {
                                    data.data.forEach(person => {
                                        const option = document.createElement('option');
                                        option.value = person.persona_id;
                                        option.textContent = `${person.nombres} ${person.apellidos} - ${person.dpi_cui || 'Sin DPI'}`;
                                        selectElement.appendChild(option);
                                    });
                                    selectElement.style.display = 'block';
                                } else {
                                    selectElement.innerHTML = '<option>No se encontraron resultados</option>';
                                    setTimeout(hideSelect, 2000); // Ocultar después de 2 segundos
                                }
                            })
                            .catch(error => {
                                console.error('Error en la búsqueda:', error);
                                selectElement.innerHTML = '<option>Error en la búsqueda</option>';
                                setTimeout(hideSelect, 2000); // Ocultar después de 2 segundos
                            });
                    }, doneTypingInterval);
                } else {
                    hideSelect();
                }
            });

            // Evento cuando se selecciona una persona
            selectElement.addEventListener('change', function() {
                if (this.selectedIndex >= 0) {
                    const selectedOption = this.options[this.selectedIndex];
                    const personaId = selectedOption.value;
                    const personaText = selectedOption.textContent;
                    
                    hiddenInput.value = personaId;
                    searchInput.value = personaText;
                    
                    // Añadir una clase para indicar que se ha seleccionado
                    searchInput.classList.add('is-valid');
                    
                    hideSelect();
                }
            });

            // Evento para manejar clics fuera del selector
            document.addEventListener('click', function(event) {
                if (event.target !== searchInput && event.target !== selectElement) {
                    hideSelect();
                }
            });
        }

        // Mostrar mensaje de éxito si existe
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    });
</script>
@endsection

