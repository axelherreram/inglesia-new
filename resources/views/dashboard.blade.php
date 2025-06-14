@extends('layouts.app')

@section('style')
    <link href="assets/plugins/vectormap/jquery-jvectormap-2.0.2.css" rel="stylesheet" />
    <link rel="stylesheet" href="{{ asset('/assets/css/dashboard.css') }}">
    <style>
        /* Estilos generales */
        .page-content {
            padding: 1.5rem;
            background-color: #f8f9fa;
        }
        
        /* Estilos para las tarjetas de estadísticas */
        .stat-card {
            border-radius: 16px;
            overflow: hidden;
            transition: all 0.3s ease;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            border: none;
            height: 100%;
        }
        
        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card .card-body {
            padding: 1.5rem;
            display: block;
            text-decoration: none;
        }
        
        .stat-card .card-title {
            font-size: 0.9rem;
            font-weight: 600;
            color: #6c757d;
            margin-bottom: 0.5rem;
        }
        
        .stat-card .stat-value {
            font-size: 2rem;
            font-weight: 700;
            margin-bottom: 0.5rem;
        }
        
        .stat-card .icon-container {
            width: 60px;
            height: 60px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
        }
        
        .stat-card .icon-container img {
            width: 32px;
            height: 32px;
            object-fit: contain;
        }
        
        /* Colores para las tarjetas */
        .border-info-custom {
            border-top: 4px solid #36b9cc !important;
        }
        
        .border-danger-custom {
            border-top: 4px solid #e74a3b !important;
        }
        
        .border-success-custom {
            border-top: 4px solid #1cc88a !important;
        }
        
        .border-warning-custom {
            border-top: 4px solid #f6c23e !important;
        }
        
        .bg-info-light {
            background-color: rgba(54, 185, 204, 0.15);
        }
        
        .bg-danger-light {
            background-color: rgba(231, 74, 59, 0.15);
        }
        
        .bg-success-light {
            background-color: rgba(28, 200, 138, 0.15);
        }
        
        .bg-warning-light {
            background-color: rgba(246, 194, 62, 0.15);
        }
        
        .text-info-custom {
            color: #36b9cc;
        }
        
        .text-danger-custom {
            color: #e74a3b;
        }
        
        .text-success-custom {
            color: #1cc88a;
        }
        
        .text-warning-custom {
            color: #f6c23e;
        }
        
        /* Estilos para las gráficas */
        .chart-card {
            border-radius: 16px;
            overflow: hidden;
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.06);
            border: none;
            margin-bottom: 1.5rem;
            background-color: white;
        }
        
        .chart-card .card-header {
            background-color: white;
            border-bottom: 1px solid #f0f0f0;
            padding: 1.25rem 1.5rem;
        }
        
        .chart-card .card-header h6 {
            font-size: 1.1rem;
            font-weight: 600;
            color: #333;
            margin: 0;
        }
        
        .chart-card .card-body {
            padding: 1.5rem;
        }
        
        .chart-container {
            position: relative;
            height: 300px;
            width: 100%;
        }
        
        /* Estilos para el dashboard en general */
        .dashboard-title {
            font-size: 1.5rem;
            font-weight: 700;
            color: #333;
            margin-bottom: 1.5rem;
        }
        
        .dashboard-subtitle {
            font-size: 1rem;
            color: #6c757d;
            margin-bottom: 2rem;
        }
        
        /* Estilos para la tarjeta de ayuda del perfil */
        .profile-help-card {
            background: linear-gradient(135deg, #4a6cf7 0%, #6a8dff 100%);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 6px 18px rgba(74, 108, 247, 0.2);
        }

        .profile-help-card .help-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .profile-help-card .help-title i {
            font-size: 1.5rem;
        }

        .profile-help-card .help-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .profile-help-card .help-text {
            flex: 1;
            font-size: 0.95rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .profile-help-card .help-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .profile-help-card .help-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        .profile-help-card .help-btn i {
            font-size: 1.2rem;
        }
        
        .stats-row {
            margin-bottom: 2rem;
        }
        
        /* Estilos para los botones de tutorial */
        .tutorial-btn {
            display: inline-flex;
            align-items: center;
            padding: 0.5rem 1rem;
            border-radius: 8px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.3s ease;
            text-decoration: none;
            margin-top: 0.75rem;
            border: none;
            cursor: pointer;
        }

        .tutorial-btn i {
            margin-right: 8px;
            font-size: 1.1rem;
        }

        .tutorial-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        .tutorial-btn-info {
            background-color: rgba(54, 185, 204, 0.1);
            color: #36b9cc;
        }

        .tutorial-btn-danger {
            background-color: rgba(231, 74, 59, 0.1);
            color: #e74a3b;
        }

        .tutorial-btn-success {
            background-color: rgba(28, 200, 138, 0.1);
            color: #1cc88a;
        }

        .tutorial-btn-warning {
            background-color: rgba(246, 194, 62, 0.1);
            color: #f6c23e;
        }
        
        /* Estilos responsivos */
        @media (max-width: 768px) {
            .stat-card .stat-value {
                font-size: 1.5rem;
            }
            
            .stat-card .icon-container {
                width: 50px;
                height: 50px;
            }
            
            .stat-card .icon-container img {
                width: 24px;
                height: 24px;
            }
        }

        /* Estilos para la tarjeta de ayuda del módulo de personas */
        .people-help-card {
            background: linear-gradient(135deg, #36b9cc 0%, #5cc9d9 100%);
            border-radius: 16px;
            padding: 1.5rem;
            margin-bottom: 2rem;
            color: white;
            box-shadow: 0 6px 18px rgba(54, 185, 204, 0.2);
        }

        .people-help-card .help-title {
            font-size: 1.25rem;
            font-weight: 600;
            margin-bottom: 1rem;
            display: flex;
            align-items: center;
            gap: 0.75rem;
        }

        .people-help-card .help-title i {
            font-size: 1.5rem;
        }

        .people-help-card .help-content {
            display: flex;
            align-items: center;
            justify-content: space-between;
            gap: 1.5rem;
        }

        .people-help-card .help-text {
            flex: 1;
            font-size: 0.95rem;
            line-height: 1.6;
            opacity: 0.9;
        }

        .people-help-card .help-btn {
            background-color: rgba(255, 255, 255, 0.2);
            color: white;
            border: 1px solid rgba(255, 255, 255, 0.3);
            padding: 0.75rem 1.5rem;
            border-radius: 8px;
            font-weight: 500;
            text-decoration: none;
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
            white-space: nowrap;
        }

        .people-help-card .help-btn:hover {
            background-color: rgba(255, 255, 255, 0.3);
            transform: translateY(-2px);
            color: white;
        }

        .people-help-card .help-btn i {
            font-size: 1.2rem;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="container-fluid">
                <h1 class="dashboard-title">Panel de Control</h1>
                <p class="dashboard-subtitle">Bienvenido al sistema de gestión parroquial. Aquí encontrarás un resumen de los sacramentos registrados.</p>
                
 
                <div class="row stats-row">
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card stat-card border-info-custom">
                            <a class="card-body" href="{{route('bautizos.index')}}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">BAUTIZOS</h5>
                                        <h2 class="stat-value text-info-custom">{{ $totalBautizos }}</h2>
                                        <p class="mb-0 text-muted">Total registrados</p>
                                    </div>
                                    <div class="icon-container bg-info-light">
                                        <img src="{{ asset('/assets/icon/bautismo.svg') }}" alt="Bautizos">
                                    </div>
                                </div>
                            </a>
                            <div class="px-3 pb-3">
                                <a href="https://www.youtube.com/watch?v=oAg1DWWrKSA" target="_blank" class="tutorial-btn tutorial-btn-info w-100">
                                    <i class='bx bx-play-circle'></i>
                                    Ver Tutorial
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card stat-card border-danger-custom">
                            <a class="card-body" href="{{route( 'comuniones.index')}}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">COMUNIONES</h5>
                                        <h2 class="stat-value text-danger-custom">{{ $totalComuniones }}</h2>
                                        <p class="mb-0 text-muted">Total registradas</p>
                                    </div>
                                    <div class="icon-container bg-danger-light">
                                        <img src="{{ asset('/assets/icon/comunion.svg') }}" alt="Comuniones">
                                    </div>
                                </div>
                            </a>
                            <div class="px-3 pb-3">
                                <a href="https://www.youtube.com/watch?v=9DLYSsSgwnk" target="_blank" class="tutorial-btn tutorial-btn-danger w-100">
                                    <i class='bx bx-play-circle'></i>
                                    Ver Tutorial
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-3 mb-4">
                        <div class="card stat-card border-success-custom">
                            <a class="card-body" href="{{route( 'confirmaciones.index')}}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">CONFIRMACIONES</h5>
                                        <h2 class="stat-value text-success-custom">{{ $totalConfirmaciones }}</h2>
                                        <p class="mb-0 text-muted">Total registradas</p>
                                    </div>
                                    <div class="icon-container bg-success-light">
                                        <img src="{{ asset('/assets/icon/confirmacion.svg') }}" alt="Confirmaciones">
                                    </div>
                                </div>
                            </a>
                            <div class="px-3 pb-3">
                                <a href="https://www.youtube.com/watch?v=amCDU7oUUTs" target="_blank" class="tutorial-btn tutorial-btn-success w-100">
                                    <i class='bx bx-play-circle'></i>
                                    Ver Tutorial
                                </a>
                            </div>
                        </div>
                    </div>
                    
                    <div class="col-12 col-md-6 col-lg-3 mb-1">
                        <div class="card stat-card border-warning-custom">
                            <a class="card-body" href="{{route( 'casamientos.index')}}">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <h5 class="card-title">CASAMIENTOS</h5>
                                        <h2 class="stat-value text-warning-custom">{{ $totalCasamientos }}</h2>
                                        <p class="mb-0 text-muted">Total registrados</p>
                                    </div>
                                    <div class="icon-container bg-warning-light">
                                        <img src="{{ asset('/assets/icon/casamiento.svg') }}" alt="Casamientos">
                                    </div>
                                </div>
                            </a>
                            <div class="px-3 pb-3">
                                <a href="https://www.youtube.com/watch?v=VCRpJg-r4W4" target="_blank" class="tutorial-btn tutorial-btn-warning w-100">
                                    <i class='bx bx-play-circle'></i>
                                    Ver Tutorial
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                               <!-- Tarjeta de ayuda del perfil -->
                               <div class="profile-help-card">
                    <div class="help-title">
                        <i class='bx bx-user-circle'></i>
                        Ayuda del Perfil
                    </div>
                    <div class="help-content">
                        <div class="help-text">
                            Aprende a gestionar tu perfil, actualizar información personal y configurar las preferencias de tu cuenta. 
                            Nuestro tutorial te guiará paso a paso en el proceso.
                        </div>
                        <a href="https://www.youtube.com/watch?v=eOFkQCY4OYU" target="_blank" class="help-btn">
                            <i class='bx bx-play-circle'></i>
                            Ver Tutorial
                        </a>
                    </div>
                </div>

                <!-- Tarjeta de ayuda del módulo de personas -->
                <div class="people-help-card">
                    <div class="help-title">
                        <i class='bx bx-group'></i>
                        Ayuda del Módulo de Personas
                    </div>
                    <div class="help-content">
                        <div class="help-text">
                            Descubre cómo gestionar el registro de personas, crear nuevos perfiles, buscar y editar información. 
                            Este tutorial te mostrará todas las funcionalidades disponibles.
                        </div>
                        <a href="https://www.youtube.com/watch?v=YOUR_PEOPLE_VIDEO_ID" target="_blank" class="help-btn">
                            <i class='bx bx-play-circle'></i>
                            Ver Tutorial
                        </a>
                    </div>
                </div>
                
                <div class="row">
                    <!-- Gráfica de Distribución por Sexo -->
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="chart-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Distribución por Sexo</h6>
                                
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="sexoChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Gráfica de Distribución por Tipo de Persona -->
                    <div class="col-12 col-lg-6 mb-4">
                        <div class="chart-card">
                            <div class="card-header d-flex justify-content-between align-items-center">
                                <h6 class="mb-0">Distribución por Tipo de Persona</h6>
                            </div>
                            <div class="card-body">
                                <div class="chart-container">
                                    <canvas id="tipoPersonaChart"></canvas>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="assets/plugins/vectormap/jquery-jvectormap-2.0.2.min.js"></script>
    <script src="assets/plugins/vectormap/jquery-jvectormap-world-mill-en.js"></script>
    <script src="assets/plugins/chartjs/js/chart.js"></script>
    <script src="assets/js/index.js"></script>
    <script>
        // Gráfica de Distribución por Sexo
        var ctxSexo = document.getElementById('sexoChart').getContext('2d');
        var sexoChart = new Chart(ctxSexo, {
            type: 'doughnut', // Cambiado a gráfico de dona para mejor visualización
            data: {
                labels: ['Masculino', 'Femenino'],
                datasets: [{
                    data: [{{ $totalHombres }}, {{ $totalMujeres }}],
                    backgroundColor: ['#4e73df', '#e83e8c'],
                    borderColor: ['#ffffff', '#ffffff'],
                    borderWidth: 2,
                    hoverOffset: 4
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                cutout: '70%',
                plugins: {
                    legend: {
                        position: 'bottom',
                        labels: {
                            padding: 20,
                            usePointStyle: true,
                            pointStyle: 'circle'
                        }
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.label || '';
                                var value = context.raw || 0;
                                var total = context.dataset.data.reduce((a, b) => a + b, 0);
                                var percentage = Math.round((value / total) * 100);
                                return `${label}: ${value} (${percentage}%)`;
                            }
                        }
                    }
                }
            }
        });
        
        // Gráfica de Distribución por Tipo de Persona
        var ctxTipoPersona = document.getElementById('tipoPersonaChart').getContext('2d');
        var tipoPersonaChart = new Chart(ctxTipoPersona, {
            type: 'bar',
            data: {
                labels: ['Feligrés', 'Sacerdote', 'Obispo'],
                datasets: [{
                    label: 'Total por Tipo de Persona',
                    data: [{{ $totalFeligreses }}, {{ $totalSacerdotes }}, {{ $totalObispos }}],
                    backgroundColor: [
                        'rgba(28, 200, 138, 0.7)',
                        'rgba(54, 185, 204, 0.7)',
                        'rgba(246, 194, 62, 0.7)'
                    ],
                    borderColor: [
                        'rgba(28, 200, 138, 1)',
                        'rgba(54, 185, 204, 1)',
                        'rgba(246, 194, 62, 1)'
                    ],
                    borderWidth: 1,
                    borderRadius: 8,
                    maxBarThickness: 50
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        display: false
                    },
                    tooltip: {
                        callbacks: {
                            label: function(context) {
                                var label = context.dataset.label || '';
                                var value = context.raw || 0;
                                return `${label}: ${value}`;
                            }
                        }
                    }
                },
                scales: {
                    y: {
                        beginAtZero: true,
                        grid: {
                            drawBorder: false,
                            color: 'rgba(0, 0, 0, 0.05)'
                        },
                        ticks: {
                            precision: 0
                        }
                    },
                    x: {
                        grid: {
                            display: false
                        }
                    }
                }
            }
        });
    </script>
@endsection