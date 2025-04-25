@extends('layouts.app')


@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="form-section">
                <div class="form-header">
                    <a href="{{ route('bautizos.index') }}" class="back-button">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h3>Editar Bautizo</h3>
                    <p>Complete el formulario para actualizar el bautizo</p>
                </div>

                <div class="form-body">
                    <form id="update-persona-form" action="{{ route('bautizos.update', $bautizo->bautizo_id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-book"></i> Información del Registro
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-4">
                                    <label for="NoPartida" class="form-label required-field">Partida No:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-ticket"></i>
                                        <input type="text" class="form-control" id="NoPartida" name="NoPartida"
                                            value="{{ old('NoPartida', $bautizo->NoPartida) }}" placeholder="Ej: 123-A">
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
                                            value="{{ old('folio', $bautizo->folio) }}" placeholder="Ej: 45">
                                    </div>
                                    @error('folio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <label for="fecha_bautizo" class="form-label required-field">Fecha de bautizo:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-calendar"></i>
                                        <input type="date" class="form-control" id="fecha_bautizo" name="fecha_bautizo"
                                        value="{{ old('fecha_bautizo', $bautizo->fecha_bautizo ? \Carbon\Carbon::parse($bautizo->fecha_bautizo)->format('Y-m-d') : '') }}">
                                    </div>
                                    @error('fecha_bautizo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-user"></i> Persona Bautizada
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="persona_bautizada_search" class="form-label required-field">Buscar Persona:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="persona_bautizada_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI (mínimo 3 caracteres)"
                                                value="{{ $bautizo->personaBautizada->nombres }} {{ $bautizo->personaBautizada->apellidos }} - {{ $bautizo->personaBautizada->dpi_cui }}">
                                        </div>
                                        <input type="hidden" id="persona_bautizada_id" name="persona_bautizada_id" value="{{ old('persona_bautizada_id', $bautizo->persona_bautizada_id) }}">
                                        <div class="search-results">
                                            <select id="select_persona_bautizada" class="form-control" style="display: none;" size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('persona_bautizada_id')
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
                                <div class="col-md-12">
                                    <label for="aldea" class="form-label">Aldea:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-home"></i>
                                        <input type="text" class="form-control" id="aldea" name="aldea" 
                                            value="{{ old('aldea', $bautizo->aldea) }}" placeholder="Nombre de la aldea">
                                    </div>
                                    @error('aldea')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="departamento_id" class="form-label required-field">Departamento:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-map"></i>
                                        <select class="form-control" id="departamento_id" name="departamento_id">
                                            <option value="">Seleccione el departamento</option>
                                            @foreach ($departamentos as $departamento)
                                                <option value="{{ $departamento->departamento_id }}" {{ old('departamento_id', $bautizo->departamento_id) == $departamento->departamento_id ? 'selected' : '' }}>
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
                                                <option value="{{ $municipio->municipio_id }}" {{ old('municipio_id', $bautizo->municipio_id) == $municipio->municipio_id ? 'selected' : '' }}>
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
                                                placeholder="Escribe el nombre, apellido o DPI"
                                                value="{{ $bautizo->padre ? $bautizo->padre->nombres . ' ' . $bautizo->padre->apellidos . ' - ' . $bautizo->padre->dpi_cui : '' }}">
                                        </div>
                                        <input type="hidden" id="padre_id" name="padre_id" value="{{ old('padre_id', $bautizo->padre_id) }}">
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
                                                placeholder="Escribe el nombre, apellido o DPI"
                                                value="{{ $bautizo->madre ? $bautizo->madre->nombres . ' ' . $bautizo->madre->apellidos . ' - ' . $bautizo->madre->dpi_cui : '' }}">
                                        </div>
                                        <input type="hidden" id="madre_id" name="madre_id" value="{{ old('madre_id', $bautizo->madre_id) }}">
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
                                <i class="lni lni-crown"></i> Sacerdote
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="sacerdote_search" class="form-label">Sacerdote:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-user"></i>
                                            <input type="text" id="sacerdote_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI"
                                                value="{{ $bautizo->sacerdote ? $bautizo->sacerdote->nombres . ' ' . $bautizo->sacerdote->apellidos . ' - ' . $bautizo->sacerdote->dpi_cui : '' }}">
                                        </div>
                                        <input type="hidden" id="sacerdote_id" name="sacerdote_id" value="{{ old('sacerdote_id', $bautizo->sacerdote_id) }}">
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

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-handshake"></i> Datos de los Padrinos
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="padrino_search" class="form-label">Padrino:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-user"></i>
                                            <input type="text" id="padrino_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI"
                                                value="{{ $bautizo->padrino ? $bautizo->padrino->nombres . ' ' . $bautizo->padrino->apellidos . ' - ' . $bautizo->padrino->dpi_cui : '' }}">
                                        </div>
                                        <input type="hidden" id="padrino_id" name="padrino_id" value="{{ old('padrino_id', $bautizo->padrino_id) }}">
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
                                <div class="col-md-6">
                                    <label for="madrina_search" class="form-label">Madrina:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-user"></i>
                                            <input type="text" id="madrina_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI"
                                                value="{{ $bautizo->madrina ? $bautizo->madrina->nombres . ' ' . $bautizo->madrina->apellidos . ' - ' . $bautizo->madrina->dpi_cui : '' }}">
                                        </div>
                                        <input type="hidden" id="madrina_id" name="madrina_id" value="{{ old('madrina_id', $bautizo->madrina_id) }}">
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

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-text-format"></i> Información Adicional
                            </div>
                            
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="margen" class="form-label">Margen:</label>
                                    <textarea class="form-control" id="margen" name="margen" rows="3" 
                                        placeholder="Información adicional o notas al margen">{{ old('margen', $bautizo->margen) }}</textarea>
                                    @error('margen')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <div class="text-muted">
                            </div>
                            <button type="button" id="submit-btn" class="submit-button">
                                <i class="lni lni-save"></i> Actualizar Bautizo
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
<!-- SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
            // Función para confirmar la actualización
            document.addEventListener('DOMContentLoaded', function() {
            // Aseguramos que el DOM esté completamente cargado
            const submitBtn = document.getElementById('submit-btn');
            const form = document.getElementById('update-persona-form');
            
            if (submitBtn && form) {
                console.log('Elementos encontrados correctamente');
                
                submitBtn.addEventListener('click', function(e) {
                    e.preventDefault(); // Prevenir cualquier comportamiento predeterminado
                    console.log('Formulario validado y listo para enviar');
                    Swal.fire({
                        title: '¿Estás seguro de que deseas actualizar este registro?',
                        text: "Esta acción no se puede deshacer.",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, actualizar',
                        cancelButtonText: 'No, cancelar',
                        reverseButtons: true
                    }).then((result) => {
                        console.log('Resultado de SweetAlert:', result);
                        
                        if (result.isConfirmed) {
                            console.log('Confirmado, enviando formulario...');
                            form.submit(); // Enviar el formulario si se confirma
                        } else {
                            console.log('Cancelado');
                        }
                    });
                });
            } else {
                console.error('No se encontraron los elementos necesarios');
            }
        });

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
                                    option.selected = municipio.municipio_id == "{{ old('municipio_id', $bautizo->municipio_id) }}";
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
            setupPersonSearch('persona_bautizada_search', 'persona_bautizada_id', 'select_persona_bautizada', 'F'); // Feligrés por defecto
            setupPersonSearch('padre_search', 'padre_id', 'select_padre', 'F'); // Feligrés por defecto
            setupPersonSearch('madre_search', 'madre_id', 'select_madre', 'F'); // Feligrés por defecto
            setupPersonSearch('sacerdote_search', 'sacerdote_id', 'select_sacerdote', 'S'); // Sacerdote
            setupPersonSearch('padrino_search', 'padrino_id', 'select_padrino', 'F'); // Feligrés por defecto
            setupPersonSearch('madrina_search', 'madrina_id', 'select_madrina', 'F'); // Feligrés por defecto

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
        });
    </script>
@endsection