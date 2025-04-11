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
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="municipio" class="form-label">Municipio</label>
                                        <div class="input-icon">
                                            <i class="lni lni-map-marker"></i>
                                            <input type="text" class="form-control" id="municipio" name="municipio"
                                                placeholder="Municipio" value="{{ $persona->municipio->municipio }}"
                                                readonly>
                                        </div>
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
    </script>
    
@endsection

