@extends('layouts.app')

<style>
    #testigos-container {
        margin-top: 20px;
    }

    #testigos-table-body tr td {
        vertical-align: middle;
    }

    .remove-testigo {
        cursor: pointer;
    }

    .testigo-item {
        background-color: #f8f9fa;
        padding: 10px;
        border-radius: 5px;
        margin-bottom: 10px;
        border: 1px solid #dee2e6;
    }
</style>
@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="persona-card">
                <div class="form-header">
                    <div class="header-content">
                        <a href="{{ route('casamientos.index') }}" class="back-button">
                            <i class="lni lni-arrow-left"></i> Regresar
                        </a>
                    </div>
                    <h2 class="persona-title mt-4" style="color: white">Editar Registro de Casamiento</h2>
                    <p class="persona-subtitle">No. Libro: {{ $casamiento->NoPartida }} • Folio: {{ $casamiento->folio }}</p>
                </div>

                <div class="info-section">
                    <form id="edit-form" action="{{ route('casamientos.update', $casamiento->casamiento_id) }}"
                        method="POST">
                        @csrf
                        @method('PUT')

                        <h3 class="section-title">Información del Casamiento</h3>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="NoPartida" class="form-label required-field">No. Libro:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-ticket"></i>
                                        <input type="text" class="form-control" id="NoPartida" name="NoPartida"
                                            value="{{ old('NoPartida', $casamiento->NoPartida) }}">
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
                                            value="{{ old('folio', $casamiento->folio) }}">
                                    </div>
                                    @error('folio')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="fecha_casamiento" class="form-label required-field">Fecha de
                                        Casamiento:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-calendar"></i>
                                        <input type="date" class="form-control" id="fecha_casamiento"
                                            name="fecha_casamiento"
                                            value="{{ old('fecha_casamiento', $casamiento->fecha_casamiento ? \Carbon\Carbon::parse($casamiento->fecha_casamiento)->format('Y-m-d') : '') }}">
                                    </div>
                                    @error('fecha_casamiento')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <h3 class="section-title">Datos del Esposo</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="esposo_search" class="form-label required-field">Buscar Esposo:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="esposo_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI (mínimo 3 caracteres)"
                                                value="{{ $casamiento->esposo ? $casamiento->esposo->nombres . ' ' . $casamiento->esposo->apellidos . ' - ' . ($casamiento->esposo->dpi_cui ?: 'Sin DPI') : '' }}">
                                        </div>
                                        <input type="hidden" id="esposo_id" name="esposo_id"
                                            value="{{ old('esposo_id', $casamiento->esposo_id) }}">
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
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="origen_esposo" class="form-label">Origen del Esposo:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-map-marker"></i>
                                        <input type="text" class="form-control" id="origen_esposo" name="origen_esposo"
                                            value="{{ old('origen_esposo', $casamiento->origen_esposo) }}">
                                    </div>
                                    @error('origen_esposo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feligresia_esposo" class="form-label">Feligresía del Esposo:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-church"></i>
                                        <input type="text" class="form-control" id="feligresesposo" name="feligresesposo"
                                     value="{{ old('feligresesposo', $casamiento->feligresesposo) }}">

                                    </div>
                                    @error('feligresia_esposo')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <h3 class="section-title">Padres del Esposo</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="padre_esposo_search" class="form-label">Padre del Esposo:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="padre_esposo_search" class="form-control"
                                                placeholder="Buscar padre del esposo"
                                                value="{{ $casamiento->padreEsposo ? $casamiento->padreEsposo->nombres . ' ' . $casamiento->padreEsposo->apellidos . ' - ' . ($casamiento->padreEsposo->dpi_cui ?: 'Sin DPI') : '' }}">
                                        </div>
                                        <input type="hidden" id="padre_esposo_id" name="padre_esposo_id"
                                            value="{{ old('padre_esposo_id', $casamiento->padre_esposo_id) }}">
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="madre_esposo_search" class="form-label">Madre del Esposo:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="madre_esposo_search" class="form-control"
                                                placeholder="Buscar madre del esposo"
                                                value="{{ $casamiento->madreEsposo ? $casamiento->madreEsposo->nombres . ' ' . $casamiento->madreEsposo->apellidos . ' - ' . ($casamiento->madreEsposo->dpi_cui ?: 'Sin DPI') : '' }}">
                                        </div>
                                        <input type="hidden" id="madre_esposo_id" name="madre_esposo_id"
                                            value="{{ old('madre_esposo_id', $casamiento->madre_esposo_id) }}">
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

                        <div class="section-divider"></div>

                        <h3 class="section-title">Datos de la Esposa</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="esposa_search" class="form-label required-field">Buscar Esposa:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="esposa_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI (mínimo 3 caracteres)"
                                                value="{{ $casamiento->esposa ? $casamiento->esposa->nombres . ' ' . $casamiento->esposa->apellidos . ' - ' . ($casamiento->esposa->dpi_cui ?: 'Sin DPI') : '' }}">
                                        </div>
                                        <input type="hidden" id="esposa_id" name="esposa_id"
                                            value="{{ old('esposa_id', $casamiento->esposa_id) }}">
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
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="origen_esposa" class="form-label">Origen de la Esposa:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-map-marker"></i>
                                        <input type="text" class="form-control" id="origen_esposa" name="origen_esposa"
                                            value="{{ old('origen_esposa', $casamiento->origen_esposa) }}">
                                    </div>
                                    @error('origen_esposa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="feligresia_esposa" class="form-label">Feligresía de la Esposa:</label>
                                    <div class="input-icon">
                                        <i class="lni lni-church"></i>
                                        <input type="text" class="form-control" id="feligresesposa" name="feligresesposa"
                                        value="{{ old('feligresesposa', $casamiento->feligresesposa) }}">

                                    </div>
                                    @error('feligresia_esposa')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <h3 class="section-title">Padres de la Esposa</h3>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="padre_esposa_search" class="form-label">Padre de la Esposa:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="padre_esposa_search" class="form-control"
                                                placeholder="Buscar padre de la esposa"
                                                value="{{ $casamiento->padreEsposa ? $casamiento->padreEsposa->nombres . ' ' . $casamiento->padreEsposa->apellidos . ' - ' . ($casamiento->padreEsposa->dpi_cui ?: 'Sin DPI') : '' }}">
                                        </div>
                                        <input type="hidden" id="padre_esposa_id" name="padre_esposa_id"
                                            value="{{ old('padre_esposa_id', $casamiento->padre_esposa_id) }}">
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
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="madre_esposa_search" class="form-label">Madre de la Esposa:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="madre_esposa_search" class="form-control"
                                                placeholder="Buscar madre de la esposa"
                                                value="{{ $casamiento->madreEsposa ? $casamiento->madreEsposa->nombres . ' ' . $casamiento->madreEsposa->apellidos . ' - ' . ($casamiento->madreEsposa->dpi_cui ?: 'Sin DPI') : '' }}">
                                        </div>
                                        <input type="hidden" id="madre_esposa_id" name="madre_esposa_id"
                                            value="{{ old('madre_esposa_id', $casamiento->madre_esposa_id) }}">
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

                        <div class="section-divider"></div>

                        <h3 class="section-title">Testigos</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="testigo_search" class="form-label">Buscar Testigo:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-search"></i>
                                            <input type="text" id="testigo_search" class="form-control"
                                                placeholder="Escribe el nombre, apellido o DPI (mínimo 3 caracteres)">
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
                        </div>

                        <!-- Contenedor para los nuevos testigos seleccionados -->
                        <div id="testigos-container" class="mb-4">
                            <!-- Aquí se agregarán los nuevos testigos seleccionados -->
                        </div>

                        <!-- Testigos existentes -->
                        <div class="card">
                            <div class="card-header">
                                <h5 class="card-title mb-0" style="color: white">Testigos Actuales del Casamiento</h5>
                            </div>
                            <div class="card-body">
                                @if($casamiento->testigos->isEmpty())
                                    <p class="text-center text-muted">No hay testigos registrados para este casamiento.</p>
                                @else
                                    <ul class="list-group">
                                        @foreach ($casamiento->testigos as $testigo)
                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                <span>{{ $testigo->persona->nombres }} {{ $testigo->persona->apellidos }}</span>
                                                <!-- Botón para eliminar testigo -->
                                                <button type="button" class="btn btn-danger btn-sm remove-testigo"
                                                    data-testigo-id="{{ $testigo->testigo_id }}">
                                                    <i class="lni lni-trash"></i> Eliminar
                                                </button>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>

                        <div class="section-divider"></div>

                        <h3 class="section-title">Párroco</h3>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="sacerdote_search" class="form-label">Sacerdote:</label>
                                    <div class="search-container">
                                        <div class="input-icon">
                                            <i class="lni lni-crown"></i>
                                            <input type="text" id="sacerdote_search" class="form-control"
                                                placeholder="Buscar sacerdote"
                                                value="{{ $casamiento->sacerdote ? $casamiento->sacerdote->nombres . ' ' . $casamiento->sacerdote->apellidos . ' - ' . ($casamiento->sacerdote->dpi_cui ?: 'Sin DPI') : '' }}">
                                        </div>
                                        <input type="hidden" id="sacerdote_id" name="sacerdote_id"
                                            value="{{ old('sacerdote_id', $casamiento->sacerdote_id) }}">
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

                        <!-- Botones de acción -->
                        <div class="action-buttons">
                            <button type="button" id="submit-btn" class="submit-button">
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
            const testigosContainer = document.getElementById("testigos-container");
            const testigoSearchInput = document.getElementById("testigo_search");
            const selectTestigo = document.getElementById("select_testigo");

            if (submitBtn && form) {
                submitBtn.addEventListener('click', function () {
                    Swal.fire({
                        title: '¿Está seguro de guardar los cambios?',
                        text: "Esta acción actualizará el registro del casamiento",
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

            // Configurar la funcionalidad para eliminar testigos existentes
            const removeButtons = document.querySelectorAll(".remove-testigo");

            if (removeButtons.length > 0) {
                removeButtons.forEach(button => {
                    button.addEventListener("click", function () {
                        const testigoId = this.getAttribute("data-testigo-id");

                        Swal.fire({
                            title: '¿Está seguro?',
                            text: "Esta acción eliminará al testigo del casamiento.",
                            icon: 'warning',
                            showCancelButton: true,
                            confirmButtonColor: '#d33',
                            cancelButtonColor: '#3085d6',
                            confirmButtonText: 'Sí, eliminar',
                            cancelButtonText: 'Cancelar'
                        }).then((result) => {
                            if (result.isConfirmed) {
                                fetch(`/casamientos/testigos/${testigoId}`, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                    .then(response => {
                                        if (!response.ok) {
                                            throw new Error('Error en la respuesta del servidor');
                                        }
                                        return response.json();
                                    })
                                    .then(data => {
                                        if (data.success) {
                                            Swal.fire({
                                                icon: 'success',
                                                title: 'Éxito',
                                                text: 'Testigo eliminado correctamente.',
                                                showConfirmButton: false,
                                                timer: 1500
                                            }).then(() => {
                                                window.location.reload();
                                            });
                                        } else {
                                            Swal.fire({
                                                icon: 'error',
                                                title: 'Error',
                                                text: 'No se pudo eliminar el testigo.',
                                            });
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Error:', error);
                                        Swal.fire({
                                            icon: 'error',
                                            title: 'Error',
                                            text: 'Ocurrió un error al eliminar el testigo.',
                                        });
                                    });
                            }
                        });
                    });
                });
            }

            // Configurar la funcionalidad para agregar nuevos testigos
            if (testigoSearchInput && selectTestigo && testigosContainer) {
                // Evento cuando se selecciona un testigo
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
                                <input type="text" class="form-control" value="${personaText}" readonly>
                                <input type="hidden" name="testigos[]" value="${personaId}">
                            </div>
                            <div class="col-md-2 d-flex align-items-center">
                                <button type="button" class="btn btn-danger btn-sm remove-new-testigo">
                                    <i class="lni lni-trash"></i>
                                </button>
                            </div>
                        `;
                        testigosContainer.appendChild(newTestigo);

                        // Limpiar el campo de búsqueda y ocultar el selector
                        testigoSearchInput.value = "";
                        selectTestigo.style.display = "none";
                    }
                });

                // Delegación de eventos para eliminar nuevos testigos
                testigosContainer.addEventListener("click", function (e) {
                    if (e.target && (e.target.classList.contains("remove-new-testigo") || e.target.closest(".remove-new-testigo"))) {
                        const testigoItem = e.target.closest(".testigo-item");
                        if (testigoItem) {
                            testigoItem.remove();
                            console.log("Nuevo testigo eliminado");
                        }
                    }
                });
            }

            // Configurar búsqueda para cada campo de persona
            setupPersonSearch('esposo_search', 'esposo_id', 'select_esposo', 'F', 'M'); // Masculino
            setupPersonSearch('esposa_search', 'esposa_id', 'select_esposa', 'F', 'F'); // Femenino
            setupPersonSearch('padre_esposo_search', 'padre_esposo_id', 'select_padre_esposo', 'F', 'M'); // Masculino
            setupPersonSearch('madre_esposo_search', 'madre_esposo_id', 'select_madre_esposo', 'F', 'F'); // Femenino
            setupPersonSearch('padre_esposa_search', 'padre_esposa_id', 'select_padre_esposa', 'F', 'M'); // Masculino
            setupPersonSearch('madre_esposa_search', 'madre_esposa_id', 'select_madre_esposa', 'F', 'F'); // Femenino
            setupPersonSearch('sacerdote_search', 'sacerdote_id', 'select_sacerdote', 'S'); // Sacerdote
            setupPersonSearch('testigo_search', null, 'select_testigo'); // Testigos

            // Función para configurar la búsqueda de personas
            function setupPersonSearch(searchInputId, hiddenInputId, selectId, tipo = null, sexo = null) {
                const searchInput = document.getElementById(searchInputId);
                const hiddenInput = hiddenInputId ? document.getElementById(hiddenInputId) : null;
                const selectElement = document.getElementById(selectId);

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

                            // Agregar el sexo si está definido
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
                            // Establecer el valor en el campo de búsqueda
                            searchInput.value = personaText;
                            // Añadir una clase para indicar que se ha seleccionado
                            searchInput.classList.add('is-valid');
                        }

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