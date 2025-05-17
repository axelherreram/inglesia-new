@extends('layouts.app')
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="form-section">
                <div class="form-header">
                    <a href="{{ route('dashboard') }}" class="back-button">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                    <h3>Crear Nuevo Casamiento</h3>
                    <p>Complete el formulario para registrar un nuevo casamiento</p>
                </div>

                <div class="form-body">
                    <form action="{{ route('casamientos.store') }}" method="POST">
                        @csrf

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
                                    <label for="fecha_casamiento" class="form-label required-field">Fecha de
                                        Casamiento:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-calendar"></i>
                                        <input type="date" class="form-control" id="fecha_casamiento"
                                            name="fecha_casamiento" value="{{ old('fecha_casamiento') }}">
                                    </div>
                                    @error('fecha_casamiento')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-user"></i> Datos del Esposo
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="esposo_search" class="form-label required-field">Buscar Esposo:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="esposo_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI (mínimo 3 caracteres)">
                                        </div>
                                        <input type="hidden" id="esposo_id" name="esposo_id" value="{{ old('esposo_id') }}">
                                        <div class="search-results">
                                            <select id="select_esposo" class="form-control" style="display: none;" size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('esposo_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="origen_esposo" class="form-label">Origen:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-map-marker"></i>
                                        <input type="text" class="form-control" id="origen_esposo" name="origen_esposo"
                                            value="{{ old('origen_esposo') }}" placeholder="Lugar de origen">
                                    </div>
                                    @error('origen_esposo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="feligresesposo" class="form-label">Feligresía:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-church"></i>
                                        <input type="text" class="form-control" id="feligresesposo" name="feligresesposo"
                                            value="{{ old('feligresesposo') }}" placeholder="Feligresía">
                                    </div>
                                    @error('feligresesposo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-users"></i> Padres del Esposo
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="padre_esposo_search" class="form-label">Padre del Esposo:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="padre_esposo_search" class="form-control"
                                                placeholder="Buscar padre del esposo">
                                        </div>
                                        <input type="hidden" id="padre_esposo_id" name="padre_esposo_id"
                                            value="{{ old('padre_esposo_id') }}">
                                        <div class="search-results">
                                            <select id="select_padre_esposo" class="form-control" style="display: none;"
                                                size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('padre_esposo_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="madre_esposo_search" class="form-label">Madre del Esposo:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="madre_esposo_search" class="form-control"
                                                placeholder="Buscar madre del esposo">
                                        </div>
                                        <input type="hidden" id="madre_esposo_id" name="madre_esposo_id"
                                            value="{{ old('madre_esposo_id') }}">
                                        <div class="search-results">
                                            <select id="select_madre_esposo" class="form-control" style="display: none;"
                                                size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('madre_esposo_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-user"></i> Datos de la Esposa
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="esposa_search" class="form-label required-field">Buscar Esposa:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="esposa_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI (mínimo 3 caracteres)">
                                        </div>
                                        <input type="hidden" id="esposa_id" name="esposa_id" value="{{ old('esposa_id') }}">
                                        <div class="search-results">
                                            <select id="select_esposa" class="form-control" style="display: none;" size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('esposa_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="origen_esposa" class="form-label">Origen:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-map-marker"></i>
                                        <input type="text" class="form-control" id="origen_esposa" name="origen_esposa"
                                            value="{{ old('origen_esposa') }}" placeholder="Lugar de origen">
                                    </div>
                                    @error('origen_esposa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="feligresesposa" class="form-label">Feligresía:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-church"></i>
                                        <input type="text" class="form-control" id="feligresesposa" name="feligresesposa"
                                            value="{{ old('feligresesposa') }}" placeholder="Feligresía">
                                    </div>
                                    @error('feligresesposa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <div class="section-title">
                                <i class="lni lni-users"></i> Padres de la Esposa
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6">
                                    <label for="padre_esposa_search" class="form-label">Padre de la Esposa:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="padre_esposa_search" class="form-control"
                                                placeholder="Buscar padre de la esposa">
                                        </div>
                                        <input type="hidden" id="padre_esposa_id" name="padre_esposa_id"
                                            value="{{ old('padre_esposa_id') }}">
                                        <div class="search-results">
                                            <select id="select_padre_esposa" class="form-control" style="display: none;"
                                                size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('padre_esposa_id')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="col-md-6">
                                    <label for="madre_esposa_search" class="form-label">Madre de la Esposa:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="madre_esposa_search" class="form-control"
                                                placeholder="Buscar madre de la esposa">
                                        </div>
                                        <input type="hidden" id="madre_esposa_id" name="madre_esposa_id"
                                            value="{{ old('madre_esposa_id') }}">
                                        <div class="search-results">
                                            <select id="select_madre_esposa" class="form-control" style="display: none;"
                                                size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                    @error('madre_esposa_id')
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
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="sacerdote_search" class="form-control"
                                                placeholder="Buscar sacerdote">
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
                                <i class="lni lni-users"></i> Testigos
                            </div>

                            <!-- Campo de búsqueda de testigos -->
                            <div class="row mb-3">
                                <div class="col-md-12">
                                    <label for="testigo_search" class="form-label">Buscar Testigo:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="testigo_search" class="form-control"
                                                placeholder="Buscar testigo">
                                        </div>
                                        <div class="search-results">
                                            <select id="select_testigo" class="form-control" style="display: none;"
                                                size="5">
                                                <!-- Opciones se llenarán con JavaScript -->
                                            </select>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Contenedor para los testigos seleccionados -->
                            <div id="testigos-container">
                                <!-- Aquí se agregarán los testigos seleccionados -->
                            </div>

                        </div>

                        <div class="d-flex justify-content-between mt-4">
                            <div class="text-muted">
                            </div>
                            <button type="submit" class="submit-button">
                                <i class="lni lni-save"></i> Guardar Casamiento
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
            const testigosContainer = document.getElementById("testigos-container");
            const testigoSearchInput = document.getElementById("testigo_search");
            const selectTestigo = document.getElementById("select_testigo");

            if (!testigoSearchInput || !selectTestigo) {
                console.error("Elementos no encontrados: testigo_search o select_testigo");
            } else {
                // Configurar búsqueda de testigos
                setupPersonSearch('testigo_search', null, 'select_testigo');
            }

            // Configurar búsqueda para cada campo de persona
            setupPersonSearch('esposo_search', 'esposo_id', 'select_esposo', 'F', 'M');
            setupPersonSearch('esposa_search', 'esposa_id', 'select_esposa', 'F', 'F');
            setupPersonSearch('padre_esposo_search', 'padre_esposo_id', 'select_padre_esposo', 'F', 'M');
            setupPersonSearch('madre_esposo_search', 'madre_esposo_id', 'select_madre_esposo', 'F', 'F');
            setupPersonSearch('padre_esposa_search', 'padre_esposa_id', 'select_padre_esposa', 'F', 'M');
            setupPersonSearch('madre_esposa_search', 'madre_esposa_id', 'select_madre_esposa', 'F', 'F');
            setupPersonSearch('sacerdote_search', 'sacerdote_id', 'select_sacerdote', 'S');

            // Cargar datos de personas seleccionadas previamente
            cargarPersonasSeleccionadas();

            // Función para agregar un testigo seleccionado
            selectTestigo.addEventListener("change", function () {
                if (this.selectedIndex >= 0) {
                    const selectedOption = this.options[this.selectedIndex];
                    const personaId = selectedOption.value;
                    const personaText = selectedOption.textContent;

                    // Crear un nuevo elemento para el testigo seleccionado
                    const newTestigo = document.createElement("div");
                    newTestigo.classList.add("row", "mb-3", "testigo-item");
                    newTestigo.innerHTML = `
                        <div class="col-md-10">
                            <input type="text" class="form-control" name="testigos_seleccionados[]" value="${personaText}" readonly>
                            <input type="hidden" name="testigos[]" value="${personaId}">
                        </div>
                        <div class="col-md-2 d-flex align-items-end">
                            <button type="button" class="btn btn-danger remove-testigo">X</button>
                        </div>
                    `;
                    testigosContainer.appendChild(newTestigo);

                    // Limpiar el campo de búsqueda y ocultar el selector
                    testigoSearchInput.value = "";
                    selectTestigo.style.display = "none";
                }
            });

            // Delegación de eventos para eliminar testigos
            testigosContainer.addEventListener("click", function (e) {
                if (e.target && e.target.classList.contains("remove-testigo")) {
                    const testigoItem = e.target.closest(".testigo-item");
                    if (testigoItem) {
                        testigoItem.remove();
                        console.log("Testigo eliminado");
                    }
                }
            });

            // Función para cargar personas seleccionadas previamente (cuando hay errores de validación)
            function cargarPersonasSeleccionadas() {
                const personaIds = {
                    'esposo_id': 'esposo_search',
                    'esposa_id': 'esposa_search',
                    'padre_esposo_id': 'padre_esposo_search',
                    'madre_esposo_id': 'madre_esposo_search',
                    'padre_esposa_id': 'padre_esposa_search',
                    'madre_esposa_id': 'madre_esposa_search',
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

            function setupPersonSearch(searchInputId, hiddenInputId, selectId, tipo = null, sexo = null) {
                const searchInput = document.getElementById(searchInputId);
                const hiddenInput = hiddenInputId ? document.getElementById(hiddenInputId) : null; // Solo busca hiddenInput si se proporciona un ID
                const selectElement = document.getElementById(selectId);

                // Verificar solo los elementos que son obligatorios
                if (!searchInput || !selectElement) {
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
                searchInput.addEventListener('input', function () {
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

                            if (sexo) {
                                url += `&sexo=${sexo}`;
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
                selectElement.addEventListener('change', function () {
                    if (this.selectedIndex >= 0) {
                        const selectedOption = this.options[this.selectedIndex];
                        const personaId = selectedOption.value;
                        const personaText = selectedOption.textContent;

                        // Si hay un campo oculto, establecer su valor
                        if (hiddenInput) {
                            hiddenInput.value = personaId;
                        }

                        // Establecer el valor en el campo de búsqueda
                        searchInput.value = personaText;

                        // Añadir una clase para indicar que se ha seleccionado
                        searchInput.classList.add('is-valid');

                        hideSelect();
                    }
                });

                // Evento para manejar clics fuera del selector
                document.addEventListener('click', function (event) {
                    if (event.target !== searchInput && event.target !== selectElement) {
                        hideSelect();
                    }
                });
            }
        });
    </script>
@endsection