<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Matrimonio</title>
    <link rel="stylesheet" href="{{ public_path('assets/css/font.css') }}">
    <style>
        body {
            font-family: 'Times New Roman', Times, serif;
            margin: 0;
            padding: 0;
            background-color: white;
            color: #000;
        }

        @page {
            size: A4;
            margin: 1cm;
        }

        .certificate {
            width: 16.59cm;
            height: 25cm;
            padding: 40px;
            margin: auto;
            border: 5px double #3d69a8;
            border-radius: 15px;
            box-sizing: border-box;
            position: relative;
        }

        .header {
            text-align: center;
            margin-bottom: 20px;
        }

        h2,
        .form-group label {
            color: #3d69a8;

        }

        h2 {
            font-family: 'Dexterous', Times, serif !important;
        }

        .form-group label {
            font-weight: 500;
            color: #3d69a8;
            font-size: 1.1rem;
        }

        .subtitle {
            font-family: 'Dexterous', Times, serif !important;
            color: #1e40af;
            font-size: 14px;
            margin: 0;
        }

        .title {
            color: #3d69a8;
            font-size: 28px;
            max-width: 300px;
            font-weight: bold;
            padding: 5px 15px;
            margin-top: 10px;
            border: 3px solid #3d69a8;
            border-radius: 7px;
            display: inline-block;
        }

        .form-content,
        .form-group span {
            font-size: 1.2rem;
            line-height: 1.6;
            /* Ajuste del interlineado */
        }

        .form-group {
            margin-bottom: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            /* Alineación vertical de los elementos del formulario */
        }

        .form-group.date-group {
            justify-content: space-evenly;
        }

        .signature {
            display: flex;
            justify-content: space-between;
            margin-top: 40px;
        }

        .signature-line {
            width: 200px;
            text-align: center;
        }

        .signature-line hr {
            margin: 0;
        }


        .text-center {
            text-align: center;
        }

        img.logo {
            position: absolute;
            height: 50px;
            top: 10px;
        }

        img.logo.left {
            top: 120px;
            left: 80px;
            width: 80px;
            height: 110px;
        }

        img.logo.right {
            right: 10px;
            height: 220px;

        }

        img.logo.cruzz {
            right: 10px;
            left: 10px;
            height: 220px;

        }

        span {
            text-decoration: underline;
        }

        img.test-image {
            display: block;
            margin: 20px auto;
            width: 100%;
            height: auto;
        }

        .h2 {
            font-family: 'Dexterous', Times, serif !important;
            color: #3d69a8;
            font-size: 2.1rem;
            text-decoration: none !important;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <img src="{{ public_path('assets/img/logo_parroquia.png') }}" alt="Logo Parroquia" class="logo left">
        <img src="{{ public_path('assets/img/Mercedes.png') }}" alt="Mercedes" class="logo right">
        <img src="{{ public_path('assets/img/Cruz.png') }}" alt="Mercedes" class="logo  cruzz">

        <div class="header">
            <span class="h2">Parroquia Nuestra Señora de Las Mercedes</span>
            <p class="subtitle">Diócesis de Jalapa</p>
            <p class="subtitle">Calle al Calvario, Barrio el Centro, Sanarate, El Progreso</p>
            <div class="title">CONSTANCIA DE MATRIMONIO</div>
        </div>

        <div class="form-content">
            <div class="form-group" style="width: 20cm;">
                <label for="parroco">El infrascrito, Párroco:</label>
                <span>{{ $casamiento->sacerdote->nombres ?? '' }} {{ $casamiento->sacerdote->apellidos ?? '' }}</span>
            </div>
            <div class="form-group">
                <label for="parroquia">de la Parroquia:</label>
                <span>Parroquia Nuestra Señora de Las Mercedes</span>
            </div>
            <p class="text-center" style=" font-weight: 500;
            color: #3d6aa8de;
            font-size: 1.1rem;">Certifica que en
                el libro de Matrimonios:</p>
            <div class="form-group">
                <label for="libro">No.:</label>
                <span>{{ $casamiento->NoPartida }}</span>
                <label for="folio" style="margin-left: 10px;">Folio:</label>
                <span>{{ $casamiento->folio }}</span>
                <label style="margin-left: 10px;">de esta Parroquia consta que:</label>
            </div>
            <div class="form-group">
                <span>{{ $casamiento->esposo->nombres ?? '' }} {{ $casamiento->esposo->apellidos ?? '' }}</span>
            </div>
            <div class="form-group">
                <label for="edad1">de</label>
                <span> {{ $casamiento->edad ?? \Carbon\Carbon::parse($casamiento->esposa->fecha_nacimiento)->age }}
                </span>
                <label for="originario1" style="margin-left: 10px;">años, originario:</label>
                <span>{{ $casamiento->origen_esposo ?? '' }}</span>
            </div>
            <div class="form-group">
                <label for="padres1">feligrés de esta Parroquia, hijo legítimo de:</label>
                <span>{{ $casamiento->padreEsposo->nombres ?? '' }} {{ $casamiento->padreEsposo->apellidos ?? '' }}
                    <span> {{ $casamiento->padreEsposo->nombres }} {{ $casamiento->padreEsposo->apellidos }}<label
                            for=""> y
                            <label for=""> y </label> {{ $casamiento->madreEsposo->nombres ?? '' }}
                            {{ $casamiento->madreEsposo->apellidos ?? '' }}</span>
            </div>
            <div class="form-group">
                <label for="nombre2">contrajo matrimonio con:</label>
                <span>{{ $casamiento->esposa->nombres }} {{ $casamiento->esposa->apellidos }}</span>
            </div>
            <div class="form-group">
                <label for="edad2">de</label>
                <span> {{ $casamiento->edad ?? \Carbon\Carbon::parse($casamiento->esposa->fecha_nacimiento)->age }}
                </span>
                <label for="originaria2" style="margin-left: 10px;">años, originaria de:</label>
                <span>{{ $casamiento->origen_esposa ?? '' }}</span>
            </div>
            <div class="form-group">
                <label for="padres2">feligrés de esta Parroquia, hija legítima de:</label>
                <span>{{ $casamiento->padreEsposa->nombres ?? '' }} {{ $casamiento->padreEsposa->apellidos ?? '' }} y
                    <label for=""> y </label> {{ $casamiento->madreEsposa->nombres ?? '' }}
                    {{ $casamiento->madreEsposa->apellidos ?? '' }}</span>

            </div>
            <div class="form-group">
                <label for="padre">Presenció y bendijo el Matrimonio el Padre:</label>
                <span>{{ $casamiento->sacerdote->nombres ?? '' }} {{ $casamiento->sacerdote->apellidos ?? '' }}</span>
            </div>

            <div class="form-group">
                <label for="nacimiento">el día</label>
                <span>{{ Date::parse($casamiento->fecha_casamiento)->locale('es')->isoFormat('D') }}</span>
                <label for="mes" style="margin-left: 5px;">de</label>
                <span>{{ Date::parse($casamiento->fecha_casamiento)->locale('es')->isoFormat('MMMM') }}</span>
                <label for="ano" style="margin-left: 5px;">de</label>
                <span>{{ Date::parse($casamiento->fecha_casamiento)->locale('es')->isoFormat('Y') }}</span>
            </div>


            <div class="form-group">
                <label for="testigos">Habiendo sido testigos:</label>
                @if($casamiento->testigos->isEmpty())
                    <p class="text-center text-muted">No hay testigos registrados para este casamiento.</p>
                @else
                    @foreach ($casamiento->testigos as $testigo)
                        <div class="list-group-item">
                            <span>{{ $testigo->persona->nombres ?? '' }} {{ $testigo->persona->apellidos ?? '' }}</span>
                        </div>
                    @endforeach
                @endif
            </div>
            <div class="form-group date-group" style="width: 16.59cm !important; margin-top:35px;">
                <span class="day">{{ now()->format('d') }}</span>
                <label>. de </label>
                <span class="month">{{ now()->locale('es')->isoFormat('MMMM') }}</span>
                <label>. de </label>
                <span class="year">{{ now()->format('Y') }}</span>
            </div>
        </div>
    </div>
</body>

</html>