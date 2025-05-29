@extends('layouts.app')


@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="persona-card">
                <div class="form-header p-4" style="color: white">
                    <div class="header-content">
                        <a href="{{ route('confirmaciones.index') }}" class="back-button">
                            <i class="lni lni-arrow-left"></i> Regresar
                        </a>
                    </div>
                    <h2 class="persona-title mt-4" style="color: white">Registro de Confirmación</h2>
                    <p class="persona-subtitle">No. Libro: {{ $confirmacion->NoPartida }} • Folio: {{ $confirmacion->folio }}
                    </p>
                </div>

                <div class="info-section">
                    <h3 class="section-title">Información de la Confirmación</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">No. Libro:</span>
                            <div class="info-value">{{ $confirmacion->NoPartida }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Folio:</span>
                            <div class="info-value">{{ $confirmacion->folio }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Fecha de Confirmación:</span>
                            <div class="info-value">
                                {{ $confirmacion->fecha_confirmacion ? \Carbon\Carbon::parse($confirmacion->fecha_confirmacion)->format('d/m/Y') : 'No especificado' }}
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Persona Confirmada</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nombre Completo:</span>
                            <div class="info-value">{{ $confirmacion->personaConfirmada->nombres }}
                                {{ $confirmacion->personaConfirmada->apellidos }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Edad:</span>
                            <div class="info-value">
                                {{ $confirmacion->edad ?? \Carbon\Carbon::parse($confirmacion->personaConfirmada->fecha_nacimiento)->age }}
                                años</div>
                        </div>
                        @if($confirmacion->nombre_parroquia_bautizo)
                            <div class="info-item" style="grid-column: span 2;">
                                <span class="info-label">Bautizado en la Parroquia:</span>
                                <div class="info-value">{{ $confirmacion->nombre_parroquia_bautizo }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Sacerdote</h3>
                    <div class="info-grid">
                        <div class="info-item" style="grid-column: span 2;">
                            <span class="info-label">Nombre del Sacerdote:</span>
                            <div class="info-value">{{ $confirmacion->sacerdote->nombres }}
                                {{ $confirmacion->sacerdote->apellidos }}</div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Padres</h3>
                    <div class="info-grid">
                        @if($confirmacion->padre)
                            <div class="info-item">
                                <span class="info-label">Padre:</span>
                                <div class="info-value">{{ $confirmacion->padre->nombres }}
                                    {{ $confirmacion->padre->apellidos }}</div>
                            </div>
                        @endif
                        @if($confirmacion->madre)
                            <div class="info-item">
                                <span class="info-label">Madre:</span>
                                <div class="info-value">{{ $confirmacion->madre->nombres }}
                                    {{ $confirmacion->madre->apellidos }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Padrinos</h3>
                    <div class="info-grid">
                        @if($confirmacion->padrino)
                            <div class="info-item">
                                <span class="info-label">Padrino:</span>
                                <div class="info-value">{{ $confirmacion->padrino->nombres }}
                                    {{ $confirmacion->padrino->apellidos }}</div>
                            </div>
                        @endif
                        @if($confirmacion->madrina)
                            <div class="info-item">
                                <span class="info-label">Madrina:</span>
                                <div class="info-value">{{ $confirmacion->madrina->nombres }}
                                    {{ $confirmacion->madrina->apellidos }}</div>
                            </div>
                        @endif
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Ubicación</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Departamento:</span>
                            <div class="info-value">{{ $confirmacion->departamento->depto ?? 'No especificado' }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Municipio:</span>
                            <div class="info-value">{{ $confirmacion->municipio->municipio ?? 'No especificado' }}</div>
                        </div>
                    </div>
                </div>

                <!-- Botón de acción -->
                <div class="action-buttons">
                    <a href="{{ route('confirmaciones.pdf', $confirmacion->confirmacion_id) }}" target="_blank"
                        class="print-button">
                        <i class="lni lni-printer"></i> Imprimir a PDF
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        @if (session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Éxito',
                text: '{{ session('success') }}',
                showConfirmButton: false,
                timer: 3000
            });
        @endif
    </script>
@endsection