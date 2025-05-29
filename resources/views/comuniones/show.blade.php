@extends('layouts.app')

@section('style')

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
                <h2 class="persona-title mt-4" style="color: white">Registro de Primera Comunión</h2>
                <p class="persona-subtitle">No. Libro: {{ $comunion->NoPartida }} • Folio: {{ $comunion->folio }}</p>
            </div>

            <div class="info-section">
                <h3 class="section-title">Información de la Comunión</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">No. Libro:</span>
                        <div class="info-value">{{ $comunion->NoPartida }}</div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Folio:</span>
                        <div class="info-value">{{ $comunion->folio }}</div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha de Comunión:</span>
                        <div class="info-value">
                            {{ $comunion->fecha_comunion ? \Carbon\Carbon::parse($comunion->fecha_comunion)->format('d/m/Y') : 'No especificado' }}
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <h3 class="section-title">Sacerdote</h3>
                <div class="info-grid">
                    <div class="info-item" style="grid-column: span 2;">
                        <span class="info-label">Nombre del Sacerdote:</span>
                        <div class="info-value">{{ $comunion->sacerdote->nombres}} {{ $comunion->sacerdote->apellidos}} </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <h3 class="section-title">Persona que recibe la Comunión</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Nombre Completo:</span>
                        <div class="info-value">{{ $comunion->personaParticipe->nombres }}
                            {{ $comunion->personaParticipe->apellidos }}
                        </div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Fecha de Nacimiento:</span>
                        <div class="info-value">
                            {{ $comunion->personaParticipe->fecha_nacimiento ? \Carbon\Carbon::parse($comunion->personaParticipe->fecha_nacimiento)->format('d/m/Y') : 'No especificado' }}
                        </div>
                    </div>
                </div>

                <div class="section-divider"></div>

                <h3 class="section-title">Padres</h3>
                <div class="info-grid">
                    <div class="info-value">
                        {{ $comunion->padre?->nombres ?? 'No registrado' }} {{ $comunion->padre?->apellidos ?? '' }}
                    </div>

                    <div class="info-value">
                        {{ $comunion->madre?->nombres ?? 'No registrada' }} {{ $comunion->madre?->apellidos ?? '' }}
                    </div>
                </div>

                <div class="section-divider"></div>

                <h3 class="section-title">Ubicación</h3>
                <div class="info-grid">
                    <div class="info-item">
                        <span class="info-label">Departamento:</span>
                        <div class="info-value">{{ $comunion->departamento->depto ?? 'No especificado' }}</div>
                    </div>
                    <div class="info-item">
                        <span class="info-label">Municipio:</span>
                        <div class="info-value">{{ $comunion->municipio->municipio ?? 'No especificado' }}</div>
                    </div>
                </div>
            </div>

            <!-- Botón de acción -->
            <div class="action-buttons">
                <a href="{{ route('comuniones.pdf', $comunion->comunion_id) }}" target="_blank" class="print-button">
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
    @if(session('success'))
    Swal.fire({
        icon: 'success',
        title: 'Éxito',
        text: '{{ session('
        success ') }}',
        showConfirmButton: false,
        timer: 3000
    });
    @endif
</script>
@endsection