@extends('layouts.app')

@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <style>
        /* Estilos generales */
        .form-container {
            max-width: 900px;
            margin: auto;
        }

        .persona-card {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            transition: all 0.3s ease;
        }
  
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="form-container">
                <div class="persona-card">
                    <div class="form-header p-4">
                        <a href="{{ route('dashboard') }}" class="back-button">
                            <i class="lni lni-arrow-left"></i> Regresar
                        </a>
                        <h3 class="page-title" style="color: white">Crear Nueva Persona</h3>
                        <p>Complete el formulario para registrar una nueva persona</p>

                    </div>

                    <form action="{{ route('personas.store') }}" method="POST" class="form-section p-4">
                        @csrf

                        <div class="section-card">
                            <h4 class="section-title">Información Personal</h4>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="nombres" class="form-label">Nombres</label>
                                        <div class="input-icon">
                                            <i class="lni lni-user"></i>
                                            <input type="text" class="form-control" id="nombres" name="nombres"
                                                placeholder="Ingrese nombres" value="{{ old('nombres') }}">
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
                                                placeholder="Ingrese apellidos" value="{{ old('apellidos') }}">
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
                                                placeholder="Ingrese DPI/CUI" value="{{ old('dpi_cui') }}">
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
                                                name="fecha_nacimiento" value="{{ old('fecha_nacimiento') }}">
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
                                                <option value="{{ $departamento->departamento_id }}" {{ old('departamento_id') == $departamento->departamento_id ? 'selected' : '' }}>
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
                                                <option value="{{ $municipio->municipio_id }}" {{ old('municipio_id') == $municipio->municipio_id ? 'selected' : '' }}>
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
                                        placeholder="Ingrese dirección completa" value="{{ old('direccion') }}">
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
                                        <select class="form-control" id="sexo" name="sexo">
                                            <option value="">Seleccione el sexo</option>
                                            <option value="M" {{ old('sexo') == 'M' ? 'selected' : '' }}>Masculino</option>
                                            <option value="F" {{ old('sexo') == 'F' ? 'selected' : '' }}>Femenino</option>
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
                                                placeholder="Ingrese número de teléfono" value="{{ old('num_telefono') }}">
                                        </div>
                                        @error('telefono')
                                            <div class="text-danger">{{ $message }}</div>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="tipo_persona" class="form-label">Tipo de Persona</label>
                                <select class="form-control" id="tipo_persona" name="tipo_persona">
                                    <option value="">Seleccione el tipo de persona</option>
                                    <option value="F" {{ old('tipo_persona') == 'F' ? 'selected' : '' }}>Feligrés</option>
                                    <option value="S" {{ old('tipo_persona') == 'S' ? 'selected' : '' }}>Sacerdote</option>
                                    <option value="O" {{ old('tipo_persona') == 'O' ? 'selected' : '' }}>Obispo</option>
                                </select>
                                @error('tipo_persona')
                                    <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="d-flex justify-content-end mt-4">
                            <button type="submit" class="submit-button">
                                <i class="lni lni-save"></i> Guardar Persona
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
        document.getElementById('departamento_id').addEventListener('change', function () {
            let departamento_id = this.value;
            let municipioSelect = document.getElementById('municipio_id');

            municipioSelect.innerHTML = '<option value="">Seleccione un municipio</option>'; // Reset municipios

            if (departamento_id) {
                fetch(`/municipios/${departamento_id}`)
                    .then(response => response.json())
                    .then(data => {
                        data.forEach(municipio => {
                            let option = document.createElement('option');
                            option.value = municipio.municipio_id;
                            option.textContent = municipio.municipio;
                            option.selected = municipio.municipio_id == {{ old('municipio_id') ?? 'null' }};
                            municipioSelect.appendChild(option);
                        });
                    })
                    .catch(error => console.error('Error al obtener municipios:', error));
            }
        });

        // Trigger change event if departamento_id has a value (for form validation errors)
        window.addEventListener('DOMContentLoaded', function () {
            const departamentoSelect = document.getElementById('departamento_id');
            if (departamentoSelect.value) {
                departamentoSelect.dispatchEvent(new Event('change'));
            }
        });
    </script>
@endsection