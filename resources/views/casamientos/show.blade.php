@extends('layouts.app')


@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="persona-card">
                <div class="form-header p-4" style="color: white;">
                    <div class="header-content">
                        <a href="{{ route('casamientos.index') }}" class="back-button">
                            <i class="lni lni-arrow-left"></i> Regresar
                        </a>
                    </div>
                    <h2 class="persona-title mt-4" style="color: white;">Registro de Casamiento</h2>
                    <p class="persona-subtitle">No. Libro: {{ $casamiento->NoPartida }} • Folio: {{ $casamiento->folio }}</p>
                </div>

                <div class="info-section">
                    <h3 class="section-title">Información del Casamiento</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">No. Libro:</span>
                            <div class="info-value">{{ $casamiento->NoPartida }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Folio:</span>
                            <div class="info-value">{{ $casamiento->folio }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Fecha de Casamiento:</span>
                            <div class="info-value">
                                {{ $casamiento->fecha_casamiento ? \Carbon\Carbon::parse($casamiento->fecha_casamiento)->format('d/m/Y') : 'No especificado' }}
                            </div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Datos del Esposo</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nombre:</span>
                            
                            <div class="info-value">{{ $casamiento->esposo->nombres }} {{ $casamiento->esposo->apellidos }}
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Edad:</span>
                            <div class="info-value">
                                {{ $casamiento->edad ?? \Carbon\Carbon::parse($casamiento->esposo->fecha_nacimiento)->age }}
                                años</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Origen:</span>
                            <div class="info-value">{{ $casamiento->origen_esposo ?: 'No especificado' }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Feligresía:</span>
                            <div class="info-value">{{ $casamiento->feligresesposo ?: 'No especificado' }}</div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Padres del Esposo</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Padre:</span>
                      <div class="info-value">
                        {{ ($casamiento->padreEsposo->nombres ?? '') . ' ' . ($casamiento->padreEsposo->apellidos ?? '') }}
                        </div>

                        </div>
                        <div class="info-item">
                            <span class="info-label">Madre:</span>
                            <div class="info-value"> {{ ($casamiento->madreEsposo->nombres ?? '') . ' ' . ($casamiento->madreEsposo->apellidos ?? '') }}</div>

                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Datos de la Esposa</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nombre:</span>
                            <div class="info-value">{{ $casamiento->esposa->nombres }} {{ $casamiento->esposa->apellidos }}
                            </div>

                        </div>
                        <div class="info-item">
                            <span class="info-label">Edad:</span>
                            <div class="info-value">
                                {{ $casamiento->edad ?? \Carbon\Carbon::parse($casamiento->esposa->fecha_nacimiento)->age }}
                                años</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Origen:</span>
                            <div class="info-value">{{ $casamiento->origen_esposa ?: 'No especificado' }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Feligresía:</span>
                            <div class="info-value">{{ $casamiento->feligresesposa ?: 'No especificado' }}</div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Padres de la Esposa</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Padre:</span>
                            <div class="info-value">{{ $casamiento->padreEsposa->nombres ?? '' }} 
                                {{ $casamiento->padreEsposa->apellidos ?? '' }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Madre:</span>
                            <div class="info-value">{{ $casamiento->madreEsposa->nombres ?? '' }} 
                                {{ $casamiento->madreEsposa->apellidos ?? 'No espeficado' }}</div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <div class="card">
                        <div class="card-header">
                            <h5 class="card-title mb-0" style="color: white">Testigos del Casamiento</h5>
                        </div>
                        <div class="card-body">
                            @if($casamiento->testigos->isEmpty())
                                <p class="text-center text-muted">No hay testigos registrados para este casamiento.</p>
                            @else
                                <ul class="list-group">
                                    @foreach ($casamiento->testigos as $testigo)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                           <span>{{ ($testigo->persona->nombres ?? '') . ' ' . ($testigo->persona->apellidos ?? '') }}</span>
                                        </li>
                                    @endforeach
                                </ul>
                            @endif
                        </div>
                    </div>
                    

                    <div class="section-divider"></div>

                    <h3 class="section-title">Párroco</h3>
                    <div class="info-item" style="grid-column: span 2;">
                        <div class="info-value">{{ $casamiento->sacerdote->nombres }}
                            {{ $casamiento->sacerdote->apellidos }}</div>
                    </div>
                </div>

                <!-- Botones de acción -->
                <div class="action-buttons">
                {{--     <a href="{{ route('casamientos.edit', $casamiento->casamiento_id) }}" class="edit-button">
                        <i class="lni lni-pencil"></i> Editar
                    </a> --}}
                    <a href="{{ route('casamientos.pdf', $casamiento->casamiento_id) }}" target="_blank"
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