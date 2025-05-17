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

        h2 {
            font-family: 'Dexterous', Times, serif !important;
            color: #3d69a8;
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

        .azul-parrafo {
            color: #3d69a8;
            text-align: justify;
            font-size: 1.2rem;
            line-height: 1.8;
        }

        .azul-parrafo .dato {
            color: #000;
            font-weight: normal;
        }

        .justificado {
            text-align: justify;
        }

        .form-group {
            margin-bottom: 10px;
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

        .form-group.date-group {
            justify-content: space-evenly;
            display: flex;
            font-size: 1.1rem;
            margin-top: 35px;
            color: #3d69a8;
        }

        .form-group.date-group .dato {
            color: #000;
        }
    </style>
</head>

<body>
    <div class="certificate">
        <img src="{{ public_path('assets/img/logo_parroquia.png') }}" alt="Logo Parroquia" class="logo left">
        <img src="{{ public_path('assets/img/Mercedes.png') }}" alt="Mercedes" class="logo right">
        <img src="{{ public_path('assets/img/Cruz.png') }}" alt="Cruz" class="logo cruzz">

        <div class="header">
            <h2>Parroquia Nuestra Señora de Las Mercedes</h2>
            <p class="subtitle">Diócesis de Jalapa</p>
            <p class="subtitle">Calle al Calvario, Barrio el Centro, Sanarate, El Progreso</p>
            <div class="title">CONSTANCIA DE MATRIMONIO</div>
        </div>

        <div class="form-content">
            <p class="text-center" style="font-weight: 500; color: #3d6aa8de; font-size: 1.1rem;">
                Certifica que en el libro de Matrimonios:
            </p>

            <p class="azul-parrafo">
                No.: <span class="dato">{{ $casamiento->NoPartida }}</span>, Folio: <span class="dato">{{ $casamiento->folio }}</span> de esta Parroquia consta que 
                <span class="dato">{{ $casamiento->esposo->nombres ?? '' }} {{ $casamiento->esposo->apellidos ?? '' }}</span>, de 
                <span class="dato">{{ $casamiento->edad ?? \Carbon\Carbon::parse($casamiento->esposo->fecha_nacimiento)->age }}</span> años, originario de 
                <span class="dato">{{ $casamiento->origen_esposo ?? '' }}</span>, feligrés de esta Parroquia, hijo legítimo de 
                <span class="dato">{{ $casamiento->padreEsposo->nombres ?? '' }} {{ $casamiento->padreEsposo->apellidos ?? '' }}</span> y 
                <span class="dato">{{ $casamiento->madreEsposo->nombres ?? '' }} {{ $casamiento->madreEsposo->apellidos ?? '' }}</span>, contrajo matrimonio con 
                <span class="dato">{{ $casamiento->esposa->nombres }} {{ $casamiento->esposa->apellidos }}</span>, de 
                <span class="dato">{{ $casamiento->edad ?? \Carbon\Carbon::parse($casamiento->esposa->fecha_nacimiento)->age }}</span> años, originaria de 
                <span class="dato">{{ $casamiento->origen_esposa ?? '' }}</span>, feligrés de esta Parroquia, hija legítima de 
                <span class="dato">{{ $casamiento->padreEsposa->nombres ?? '' }} {{ $casamiento->padreEsposa->apellidos ?? '' }}</span> y 
                <span class="dato">{{ $casamiento->madreEsposa->nombres ?? '' }} {{ $casamiento->madreEsposa->apellidos ?? '' }}</span>.
            </p>

            <p class="azul-parrafo">
                Presenció y bendijo el Matrimonio el Padre 
                <span class="dato">{{ $casamiento->sacerdote->nombres ?? '' }} {{ $casamiento->sacerdote->apellidos ?? '' }}</span>, el día 
                <span class="dato">{{ Date::parse($casamiento->fecha_casamiento)->locale('es')->isoFormat('D') }}</span> de 
                <span class="dato">{{ Date::parse($casamiento->fecha_casamiento)->locale('es')->isoFormat('MMMM') }}</span> de 
                <span class="dato">{{ Date::parse($casamiento->fecha_casamiento)->locale('es')->isoFormat('Y') }}</span>.
            </p>

            <div class="form-group azul-parrafo">
                @if($casamiento->testigos->isEmpty())
                    <p class="dato justificado">Habiendo sido testigos: <span class="text-muted">No hay testigos registrados para este casamiento.</span></p>
                @else
                    <p class="justificado">
                        Habiendo sido testigos: 
                        @foreach ($casamiento->testigos as $index => $testigo)
                            <span class="dato">{{ $testigo->persona->nombres ?? '' }} {{ $testigo->persona->apellidos ?? '' }}</span>@if(!$loop->last), @endif
                        @endforeach
                    </p>
                @endif
            </div>



            <div class="form-group" style="text-align: center; color: #3d69a8; font-size: 1.1rem; margin-top: 35px;">
                <span class="dato">{{ now()->format('d') }}</span>
                <span>. de </span>
                <span class="dato">{{ now()->locale('es')->isoFormat('MMMM') }}</span>
                <span>. de </span>
                <span class="dato">{{ now()->format('Y') }}</span>
            </div>
        </div>
    </div>
</body>

</html>
