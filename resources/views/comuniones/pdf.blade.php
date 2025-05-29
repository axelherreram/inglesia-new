<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Primera Comunín</title>
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
            font-size: 27px;
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

        .form-group.date-group {
            font-size: 1.1rem;
            margin-top: 35px;
            color: #3d69a8;
            text-align: center;
        }

        .form-group.date-group .dato {
            color: #000;
        }

        .signature-line {
            text-align: center;
            margin-top: 80px;
            color: #3d69a8;
        }

        .signature-line hr {
            width: 200px;
            margin: 0 auto 5px auto;
            border-top: 1px solid #3d69a8;
        }

        .signature-line p {
            margin: 0;
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

        .text-center {
            text-align: center;
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
        <img src="{{ public_path('assets/img/Cruz.png') }}" alt="Cruz" class="logo cruzz">

        <div class="header">
            <h2>Parroquia Nuestra Señora de Las Mercedes</h2>
            <p class="subtitle">Diócesis de Jalapa</p>
            <p class="subtitle">Calle al Calvario, Barrio el Centro, Sanarate, El Progreso</p>
            <div class="title">CONSTANCIA DE PRIMERA COMUNIÓN</div>
        </div>

        <div class="form-content">
            <p class="azul-parrafo" style="margin-bottom: 0;">
                El infrascrito, Párroco de <span class="dato">Parroquia Nuestra Señora de Las Mercedes</span>,
            </p>

            <p class="text-center azul-parrafo" style="margin-top: 0;">
                Certifica que en el libro de PRIMERAS COMUNIONES:
            </p>

            <p class="azul-parrafo">
                No.: <span class="dato">{{ $comunion->NoPartida }}</span>, Folio: <span class="dato">{{ $comunion->folio }}</span> de esta Parroquia consta que 
                <span class="dato">{{ $comunion->personaParticipe->nombres }} {{ $comunion->personaParticipe->apellidos }}</span>,
                hijo de <span class="dato">{{ $comunion->padre?->nombres ?? '' }} {{ $comunion->padre?->apellidos ?? '' }}</span> y 
                <span class="dato">{{ $comunion->madre?->nombres ?? '' }} {{ $comunion->madre?->apellidos ?? '' }}</span>,
                nacido el <span class="dato">{{ \Carbon\Carbon::parse($comunion->personaParticipe->fecha_nacimiento)->locale('es')->isoFormat('D') }}</span> de 
                <span class="dato">{{ \Carbon\Carbon::parse($comunion->personaParticipe->fecha_nacimiento)->locale('es')->isoFormat('MMMM') }}</span> del año 
                <span class="dato">{{ \Carbon\Carbon::parse($comunion->personaParticipe->fecha_nacimiento)->locale('es')->isoFormat('Y') }}</span>,
                realizó su Primera Comunión en esta Parroquia el día <span class="dato">{{ \Carbon\Carbon::parse($comunion->fecha_comunion)->format('d') }}</span> de 
                <span class="dato">{{ \Carbon\Carbon::parse($comunion->fecha_comunion)->locale('es')->isoFormat('MMMM') }}</span> del año 
                <span class="dato">{{ \Carbon\Carbon::parse($comunion->fecha_comunion)->format('Y') }}</span>.
            </p>

            <div class="form-group date-group">
                <span>Sansare, </span>
                <span class="dato">{{ now()->format('d') }}</span>
                <span> de </span>
                <span class="dato">{{ now()->locale('es')->isoFormat('MMMM') }}</span>
                <span> de </span>
                <span class="dato">{{ now()->format('Y') }}</span>
            </div>
        </div>

        <div class="signature-line">
            <hr>
            <p><strong>Párroco</strong></p>
        </div>
    </div>
</body>

</html>
