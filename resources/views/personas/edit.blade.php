@extends('layouts.app')

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="form-container">
                <div class="persona-card">
                    <div class="form-header p-4">
                        <a href="{{ route('personas.index') }}" class="back-button">
                            <i class="lni lni-arrow-left"></i> Regresar
                        </a>
                        <h3 class="page-title">Editar Persona</h3>
                    </div>

                    <form id="update-persona-form" action="{{ route('personas.update', $persona->persona_id) }}" method="POST" class="form-section p-4">
                        @csrf
                        @method('PUT')

                        <div class="section-card">
                            <h4 class="section-title">Información Personal</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <div class="input-icon">
                                            <i class="lni lni-user"></i>
                                            <input type="text" class="form-control" id="nombres" name="nombres"
                                                placeholder="Ingrese nombres" value="{{ $persona->nombres }}" required>
                                        </div>
                                        @error('nombres')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="apellidos" class="form-label">Apellidos</label>
                                        <div class="input-icon">
                                            <i class="lni lni-user"></i>
                                            <input type="text" class="form-control" id="apellidos" name="apellidos"
                                                placeholder="Ingrese apellidos" value="{{ $persona->apellidos }}" required>
                                        </div>
                                        @error('apellidos')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="dpi_cui" class="form-label">DPI/CUI</label>
                                        <div class="input-icon">
                                            <i class="lni lni-id-card"></i>
                                            <input type="text" class="form-control" id="dpi_cui" name="dpi_cui"
                                                placeholder="Ingrese DPI/CUI" value="{{ $persona->dpi_cui }}" required>
                                        </div>
                                        @error('dpi_cui')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="fecha_nacimiento" class="form-label">Fecha de Nacimiento</label>
                                        <div class="input-icon">
                                            <i class="lni lni-calendar"></i>
                                            <input type="date" class="form-control" id="fecha_nacimiento"
                                                name="fecha_nacimiento" value="{{ $persona->fecha_nacimiento }}" required>
                                        </div>
                                        @error('fecha_nacimiento')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="section-card">
                            <h4 class="section-title">Ubicación</h4>
                            <div class="row">
                            <div class="col-md-6">
                            <div class="form-group">
                                <label for="departamento_id" class="form-label">Departamento</label>
                                <select class="form-control" id="departamento_id" name="departamento_id">
                            <option value="">Seleccione un departamento</option>
                            @foreach($departamentos as $departamento)
                                <option value="{{ $departamento->departamento_id }}"
                                    {{ $persona->municipio->departamento_id == $departamento->departamento_id ? 'selected' : '' }}>
                                    {{ $departamento->depto }}
                                </option>
                            @endforeach
                        </select>   
                                @error('departamento_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="municipio_id" class="form-label">Municipio</label>
                                <select class="form-control" id="municipio_id" name="municipio_id">
                                <option value="">Seleccione un municipio</option>
                                @foreach($municipios as $municipio)
                                    <option value="{{ $municipio->municipio_id }}"
                                        {{ $persona->municipio_id == $municipio->municipio_id ? 'selected' : '' }}>
                                        {{ $municipio->municipio }}
                                    </option>
                                @endforeach
                            </select>   
                                @error('municipio_id')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror

                            </div>
                        </div>
                        </div>


                            <div class="form-group">
                                <label for="direccion" class="form-label">Dirección</label>
                                <div class="input-icon">
                                    <i class="lni lni-map-marker"></i>
                                    <input type="text" class="form-control" id="direccion" name="direccion"
                                        placeholder="Ingrese dirección completa" value="{{ $persona->direccion }}" required>
                                </div>
                                @error('direccion')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="section-card">
                            <h4 class="section-title">Información Adicional</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="sexo" class="form-label">Sexo</label>
                                        <select class="form-control" id="sexo" name="sexo" required>
                                            <option value="M" {{ $persona->sexo == 'M' ? 'selected' : '' }}>Masculino</option>
                                            <option value="F" {{ $persona->sexo == 'F' ? 'selected' : '' }}>Femenino</option>
                                            <option value="O" {{ $persona->sexo == 'O' ? 'selected' : '' }}>Otro</option>
                                        </select>
                                        @error('sexo')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="num_telefono" class="form-label">Teléfono</label>
                                        <div class="input-icon">
                                            <i class="lni lni-phone"></i>
                                            <input type="text" class="form-control" id="num_telefono" name="num_telefono"
                                                placeholder="Ingrese número de teléfono"
                                                value="{{ $persona->num_telefono }}" required>
                                        </div>
                                        @error('num_telefono')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tipo_persona" class="form-label">Tipo de Persona</label>
                                <select class="form-control" id="tipo_persona" name="tipo_persona" required>
                                    <option value="F" {{ $persona->tipo_persona == 'F' ? 'selected' : '' }}>Feligrés</option>
                                    <option value="S" {{ $persona->tipo_persona == 'S' ? 'selected' : '' }}>Sacerdote</option>
                                    <option value="O" {{ $persona->tipo_persona == 'O' ? 'selected' : '' }}>Obispo</option>
                                </select>
                                @error('tipo_persona')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" id="submit-btn" class="submit-button">
                                <i class="lni lni-save"></i> Actualizar Persona
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


                // CARGA DINÁMICA DE MUNICIPIOS EN EL FORMULARIO DE EDICIÓN
        document.getElementById('departamento_id').addEventListener('change', function () {
            let departamento_id = this.value;
            let municipioSelect = document.getElementById('municipio_id');

            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';

            if (departamento_id) {
                fetch(`/municipios/${departamento_id}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(municipio => {
                            let option = document.createElement('option');
                            option.value = municipio.municipio_id;
                            option.textContent = municipio.municipio;
                            municipioSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al obtener municipios:', error));
            }
        });

        // Cargar municipios al cargar la página si hay un departamento seleccionado
        window.addEventListener('DOMContentLoaded', function () {
            const departamentoSelect = document.getElementById('departamento_id');
            const municipioSelect = document.getElementById('municipio_id');
            const selectedMunicipioId = "{{ $persona->municipio_id }}";

            if (departamentoSelect.value) {
                fetch(`/municipios/${departamentoSelect.value}`)
                    .then(response => response.json())
                    .then(data => {
                        municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>';
                        data.forEach(municipio => {
                            const option = document.createElement('option');
                            option.value = municipio.municipio_id;
                            option.textContent = municipio.municipio;

                            if (municipio.municipio_id == selectedMunicipioId) {
                                option.selected = true;
                            }

                            municipioSelect.appendChild(option);
                        });
                    });
            }
        });
    </script>
    
@endsection

