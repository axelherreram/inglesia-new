@extends('layouts.app')

@section('style')
  <style>
      .persona-card {
          background-color: white;
          border-radius: 12px;
          box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
          overflow: hidden;
          transition: all 0.3s ease;
          max-width: 900px;
          margin: 0 auto;
      }

      .persona-card:hover {
          box-shadow: 0 8px 30px rgba(0, 0, 0, 0.12);
      }

      .card-header {
          background: linear-gradient(135deg, #4a6cf7 0%, #2b3cf7 100%);
          color: white;
          padding: 20px 25px;
          position: relative;
      }

      .header-content {
          display: flex;
          justify-content: space-between;
          align-items: center;
      }

      .back-button {
          background-color: rgba(255, 255, 255, 0.2);
          color: white;
          border: none;
          border-radius: 8px;
          padding: 8px 16px;
          display: flex;
          align-items: center;
          gap: 8px;
          transition: all 0.2s ease;
      }

      .back-button:hover {
          background-color: rgba(255, 255, 255, 0.3);
          text-decoration: none;
          color: white;
      }

      .persona-title {
          font-size: 1.5rem;
          font-weight: 700;
          margin: 0;
          padding: 0;
      }

      .persona-subtitle {
          font-size: 1rem;
          opacity: 0.8;
          margin-top: 5px;
      }

      .info-section {
          padding: 25px;
      }

      .form-group {
          margin-bottom: 20px;
      }

      .form-label {
          font-weight: 600;
          color: #555;
          font-size: 0.9rem;
          margin-bottom: 8px;
          display: block;
      }

      .form-control {
          border: 1px solid #e0e0e0;
          border-radius: 10px;
          padding: 12px 15px;
          font-size: 0.95rem;
          transition: all 0.3s ease;
          background-color: #f9f9f9;
          width: 100%;
      }

      .form-control:focus {
          border-color: #4a6cf7;
          box-shadow: 0 0 0 3px rgba(74, 108, 247, 0.15);
          background-color: #fff;
      }

      .section-divider {
          margin: 20px 0;
          height: 1px;
          background-color: #eee;
      }

      .section-title {
          font-weight: 600;
          color: #4a6cf7;
          margin-bottom: 15px;
          padding-bottom: 8px;
          border-bottom: 2px solid #eee;
      }

      .action-buttons {
          display: flex;
          justify-content: space-between;
          margin-top: 25px;
          padding: 0 25px 25px;
      }

      .cancel-button {
          background-color: #f8f9fa;
          color: #555;
          border: 1px solid #ddd;
          border-radius: 8px;
          padding: 12px 24px;
          font-weight: 600;
          display: flex;
          align-items: center;
          gap: 8px;
          transition: all 0.2s ease;
      }

      .cancel-button:hover {
          background-color: #e9ecef;
          color: #333;
          text-decoration: none;
      }

      .save-button {
          background: linear-gradient(135deg, #4a6cf7 0%, #2b3cf7 100%);
          color: white;
          border: none;
          border-radius: 8px;
          padding: 12px 24px;
          font-weight: 600;
          display: flex;
          align-items: center;
          gap: 8px;
          transition: all 0.2s ease;
      }

      .save-button:hover {
          transform: translateY(-2px);
          box-shadow: 0 4px 12px rgba(43, 60, 247, 0.3);
          color: white;
          text-decoration: none;
      }

      .search-container {
          position: relative;
          margin-bottom: 15px;
      }

      .search-results {
          position: absolute;
          width: 100%;
          max-height: 200px;
          overflow-y: auto;
          background-color: white;
          border: 1px solid #e0e0e0;
          border-radius: 0 0 10px 10px;
          box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
          z-index: 10;
      }

      .search-results select {
          width: 100%;
          border: none;
          border-radius: 0;
          box-shadow: none;
      }

      .search-results select option {
          padding: 12px 15px;
          cursor: pointer;
          transition: all 0.2s ease;
      }

      .search-results select option:hover {
          background-color: #f5f7ff;
      }

      .input-icon {
          position: relative;
      }

      .input-icon i {
          position: absolute;
          top: 50%;
          transform: translateY(-50%);
          left: 15px;
          color: #aaa;
      }

      .input-icon .form-control {
          padding-left: 40px;
      }

      .required-field::after {
          content: '*';
          color: #e74c3c;
          margin-left: 4px;
      }

      .text-danger {
          color: #e74c3c;
          font-size: 0.85rem;
          margin-top: 5px;
          display: block;
      }

      /* Responsive design */
      @media (max-width: 768px) {
          .info-section {
              padding: 15px;
          }
          
          .action-buttons {
              flex-direction: column;
              gap: 10px;
              padding: 0 15px 15px;
          }
          
          .cancel-button, .save-button {
              width: 100%;
              justify-content: center;
          }
      }
  </style>
@endsection

@section('wrapper')
  <div class="page-wrapper">
      <div class="page-content">
          <div class="persona-card">
              <div class="form-header p-4" style="color: white">
                  <div class="header-content">
                      <a href="{{ route('comuniones.index') }}" class="back-button">
                          <i class="lni lni-arrow-left"></i> Regresar
                      </a>
                  </div>
                  <h2 class="persona-title mt-4" style="color: white">Editar Registro de Primera Comunión</h2>
                  <p class="persona-subtitle" >No. Libro: {{ $comunion->NoPartida }} • Folio: {{ $comunion->folio }}</p>
              </div>

              <div class="info-section">
                  <form id="edit-form" action="{{ route('comuniones.update', $comunion->comunion_id) }}" method="POST">
                      @csrf
                      @method('PUT')
                      
                      <h3 class="section-title">Información de la Comunión</h3>
                      <div class="row">
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="NoPartida" class="form-label required-field">No. Libro:</label>
                                  <div class="input-icon">
                                      <i class="lni lni-ticket"></i>
                                      <input type="text" class="form-control" id="NoPartida" name="NoPartida" 
                                          value="{{ old('NoPartida', $comunion->NoPartida) }}">
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
                                          value="{{ old('folio', $comunion->folio) }}">
                                  </div>
                                  @error('folio')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                          </div>
                          <div class="col-md-4">
                              <div class="form-group">
                                  <label for="fecha_comunion" class="form-label required-field">Fecha de Comunión:</label>
                                  <div class="input-icon">
                                      <i class="lni lni-calendar"></i>
                                      <input type="date" class="form-control" id="fecha_comunion" name="fecha_comunion" 
                                          value="{{ old('fecha_comunion', $comunion->fecha_comunion ? \Carbon\Carbon::parse($comunion->fecha_comunion)->format('Y-m-d') : '') }}">
                                  </div>
                                  @error('fecha_comunion')
                                      <span class="text-danger">{{ $message }}</span>
                                  @enderror
                              </div>
                          </div>
                      </div>

                      <div class="section-divider"></div>
                      
                      <h3 class="section-title">Persona que recibe la Comunión</h3>
                      <div class="row">
                          <div class="col-md-12">
                              <div class="form-group">
                                  <label for="persona_comunion_search" class="form-label required-field">Buscar Persona:</label>
                                  <div class="search-container">
                                      <div class="input-icon">
                                          <i class="lni lni-search"></i>
                                          <input type="text" id="persona_comunion_search" class="form-control"
                                              placeholder="Escribe el nombre, apellido o DPI" 
                                              value="{{ $comunion->personaParticipe ? $comunion->personaParticipe->nombres . ' ' . $comunion->personaParticipe->apellidos . ' - ' . ($comunion->personaParticipe->dpi_cui ?: 'Sin DPI') : '' }}">
                                      </div>
                                      <input type="hidden" id="persona_participe_id" name="persona_participe_id" 
                                          value="{{ old('persona_participe_id', $comunion->persona_participe_id) }}">
                                      <div class="search-results">
                                          <select id="select_persona_comunion" class="form-control" style="display: none;" size="5">
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
                                              value="{{ $comunion->padre ? $comunion->padre->nombres . ' ' . $comunion->padre->apellidos . ' - ' . ($comunion->padre->dpi_cui ?: 'Sin DPI') : '' }}">
                                      </div>
                                      <input type="hidden" id="padre_id" name="padre_id" 
                                          value="{{ old('padre_id', $comunion->padre_id) }}">
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
                                              value="{{ $comunion->madre ? $comunion->madre->nombres . ' ' . $comunion->madre->apellidos . ' - ' . ($comunion->madre->dpi_cui ?: 'Sin DPI') : '' }}">
                                      </div>
                                      <input type="hidden" id="madre_id" name="madre_id" 
                                          value="{{ old('madre_id', $comunion->madre_id) }}">
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
                                              value="{{ $comunion->sacerdote ? $comunion->sacerdote->nombres . ' ' . $comunion->sacerdote->apellidos . ' - ' . ($comunion->sacerdote->dpi_cui ?: 'Sin DPI') : '' }}">
                                      </div>
                                      <input type="hidden" id="sacerdote_id" name="sacerdote_id" 
                                          value="{{ old('sacerdote_id', $comunion->sacerdote_id) }}">
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
                                                  {{ old('departamento_id', $comunion->departamento_id) == $departamento->departamento_id ? 'selected' : '' }}>
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
                                                  {{ old('municipio_id', $comunion->municipio_id) == $municipio->municipio_id ? 'selected' : '' }}>
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
          
          submitBtn.addEventListener('click', function() {
              Swal.fire({
                  title: '¿Está seguro de guardar los cambios?',
                  text: "Esta acción actualizará el registro de la primera comunión",
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
                                  option.selected = municipio.municipio_id == "{{ old('municipio_id', $comunion->municipio_id) }}";
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
          setupPersonSearch('persona_comunion_search', 'persona_participe_id', 'select_persona_comunion', 'F'); // Feligrés por defecto
          setupPersonSearch('padre_search', 'padre_id', 'select_padre', 'F'); // Feligrés por defecto
          setupPersonSearch('madre_search', 'madre_id', 'select_madre', 'F'); // Feligrés por defecto
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

