@extends('layouts.app')

@section('wrapper')
<div class="page-wrapper">
    <div class="page-content">
        <div class="persona-card">
            <div class="form-header p-4" style="color: white">
                <div class="header-content">
                    <a href="{{ route('bautizos.index') }}" class="back-button">
                        <i class="lni lni-arrow-left"></i> Regresar
                    </a>
                </div>
                <h2 class="persona-title mt-4" style="color: white">Registro de Bautizo</h2>
                <p class="persona-subtitle">Partida: {{ $bautizo->NoPartida }} • Folio: {{ $bautizo->folio }}</p>
            </div>

            <div class="info-section">
                <h3 class="section-title">Información del Bautizo</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Partida No:</span>
                        <div class="info-value">{{ $bautizo->NoPartida }}</div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Folio:</span>
                        <div class="info-value">{{ $bautizo->folio }}</div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha de Bautizo:</span>
                        <div class="info-value">
                            {{ $bautizo->fecha_bautizo ? \Carbon\Carbon::parse($bautizo->fecha_bautizo)->format('d/m/Y') : 'No especificado' }}
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Aldea:</span>
                        <div class="info-value">{{ $bautizo->aldea ?: 'No especificado' }}</div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <h3 class="section-title">Persona Bautizada</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nombre Completo:</span>
                        <div class="info-value">{{ $bautizo->personaBautizada->nombres }}
                            {{ $bautizo->personaBautizada->apellidos }}
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Edad:</span>
                        <div class="info-value">
                            {{ \Carbon\Carbon::parse($bautizo->personaBautizada->fecha_nacimiento)->age }} años
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha de Nacimiento:</span>
                        <div class="info-value">
                            {{ $bautizo->personaBautizada->fecha_nacimiento ? \Carbon\Carbon::parse($bautizo->personaBautizada->fecha_nacimiento)->format('d/m/Y') : 'No especificado' }}
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <h3 class="section-title">Ubicación</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Departamento:</span>
                        <div class="info-value">{{ $bautizo->departamento->depto ?? 'No especificado' }}</div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Municipio:</span>
                        <div class="info-value">{{ $bautizo->municipio->municipio ?? 'No especificado' }}</div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <h3 class="section-title">Padres</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Padre:</span>
                        <div class="info-value">
                            {{ $bautizo->padre?->nombres ?? 'No registrado' }} {{ $bautizo->padre?->apellidos ?? '' }}
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Madre:</span>
                        <div class="info-value">
                            {{ $bautizo->madre?->nombres ?? 'No registrada' }} {{ $bautizo->madre?->apellidos ?? '' }}
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <h3 class="section-title">Padrinos</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Padrino:</span>
                        <div class="info-value">
                            {{ $bautizo->padrino?->nombres ?? 'No registrado' }} {{ $bautizo->padrino?->apellidos ?? '' }}
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Madrina:</span>
                        <div class="info-value">
                            {{ $bautizo->madrina?->nombres ?? 'No registrada' }} {{ $bautizo->madrina?->apellidos ?? '' }}
                        </div>
                    </div>
                </div>


                <div class="section-divider"></div>

                <h3 class="section-title">Sacerdote</h3>
                <div class="info-grid">
                    <div class="info-item" style="grid-column: span 2;">
                        <span class="info-label">Nombre del Sacerdote:</span>
                        <div class="info-value">
                            {{ $bautizo->sacerdote?->nombres ?? 'No registrado' }} {{ $bautizo->sacerdote?->apellidos ?? '' }}
                        </div>
                    </div>
                </div>


                @if($bautizo->margen)
                <div class="section-divider"></div>

                <h3 class="section-title">Información Adicional</h3>
                <div class="info-grid">
                    <div class="info-item" style="grid-column: span 2;">
                        <span class="info-label">Margen:</span>
                        <div class="info-value">{{ $bautizo->margen }}</div>
                    </div>
                </div>
                @endif
            </div>

            <!-- Botón de acción -->
            <div class="action-buttons">
                {{-- <a href="{{ route('bautizos.edit', $bautizo->bautizo_id) }}" class="btn-edit">
                <i class="lni lni-pencil"></i> Editar
                </a> --}}
                <a href="{{ route('bautizo.pdf', $bautizo->bautizo_id) }}" target="_blank" class="print-button">
                    <i class="lni lni-printer"></i> Imprimir a PDF
                </a>
            </div>
        </div>
    </div>
</div>
@endsection