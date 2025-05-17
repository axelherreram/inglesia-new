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

        .btn-custom {
            margin-left: 3px;
            background-color: white !important
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

        .info-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
        }

        .info-item {
            margin-bottom: 15px;
        }

        .info-label {
            font-weight: 600;
            color: #555;
            font-size: 0.9rem;
            margin-bottom: 5px;
            display: block;
        }

        .info-value {
            color: #333;
            font-size: 1.05rem;
            padding: 8px 12px;
            background-color: #f8f9fa;
            border-radius: 6px;
            border-left: 3px solid #4a6cf7;
        }

        .action-buttons {
            display: flex;
            justify-content: flex-end;
            margin-top: 25px;
            padding: 0 25px 25px;
        }

        .edit-button {
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

        .edit-button:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(43, 60, 247, 0.3);
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

        /* Responsive design */
        @media (max-width: 768px) {
            .info-grid {
                grid-template-columns: 1fr;
            }

            .card-header {
                padding: 15px 20px;
            }

            .info-section {
                padding: 15px;
            }

            .action-buttons {
                padding: 0 15px 15px;
            }
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="persona-card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <a href="{{ route('personas.index') }}" class="btn btn-custom">
                            <i class="lni lni-arrow-left"></i> Regresar
                        </a>
                        <div class="text-center text-white p-3">
                            <h2 class="persona-title mt-2" style="color: white">{{ $persona->nombres }}
                                {{ $persona->apellidos }}
                            </h2>
                            <p class="persona-subtitle">
                                @if($persona->tipo_persona == 'F')
                                    Feligrés
                                @elseif($persona->tipo_persona == 'S')
                                    Sacerdote
                                @elseif($persona->tipo_persona == 'O')
                                    Obispo
                                @endif
                                • DPI: {{ $persona->dpi_cui }}
                            </p>
                        </div>
                    </div>
                </div>



                <div class="info-section">
                    <h3 class="section-title">Información Personal</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Nombres:</span>
                            <div class="info-value">{{ $persona->nombres }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Apellidos:</span>
                            <div class="info-value">{{ $persona->apellidos }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">DPI/CUI:</span>
                            <div class="info-value">{{ $persona->dpi_cui }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Municipio:</span>
                            <div class="info-value">{{ $persona->municipio->municipio }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Fecha de Nacimiento:</span>
                            <div class="info-value">{{ \Carbon\Carbon::parse($persona->fecha_nacimiento)->format('d/m/Y') }}
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Sexo:</span>
                            <div class="info-value">
                                @if ($persona->sexo == 'M')
                                    Masculino
                                @elseif($persona->sexo == 'F')
                                    Femenino
                                @else
                                    No especificado
                                @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Número de Teléfono:</span>
                            <div class="info-value">{{ $persona->num_telefono ?? 'No disponible' }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Tipo de Persona:</span>
                            <div class="info-value">{{ $persona->tipo_persona }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Dirección:</span>
                            <div class="info-value">{{ $persona->direccion ?? 'No disponible' }}</div>
                        </div>
                    </div>

                    <div class="section-divider"></div>

                    <h3 class="section-title">Relaciones Familiares</h3>
                    <div class="info-grid">
                        <div class="info-item">
                            <span class="info-label">Padre:</span>
                            <div class="info-value">@if ($persona->padre)
                                {{ $persona->padre->nombres }} {{ $persona->padre->apellidos }}
                            @else
                                No especificado
                            @endif
                            </div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Madre:</span>
                            <div class="info-value"> @if ($persona->madre)
                                {{ $persona->madre->nombres }} {{ $persona->madre->apellidos }}
                            @else
                                No especificado
                            @endif
                            </div>
                        </div>
                 {{--        <div class="info-item">
                            <span class="info-label">Padrino:</span>
                            <div class="info-value">{{ $persona->padrino_id ?? 'No disponible' }}</div>
                        </div>
                        <div class="info-item">
                            <span class="info-label">Madrina:</span>
                            <div class="info-value">{{ $persona->madrina_id ?? 'No disponible' }}</div>
                        </div> --}}
                    </div>
                </div>

                <!-- Botón de acción -->
                <div class="action-buttons">
                    <a href="{{ route('personas.edit', $persona->persona_id) }}" class="edit-button">
                        <i class="lni lni-pencil"></i> Editar Información
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection