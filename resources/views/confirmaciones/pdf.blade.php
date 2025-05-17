<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Constancia de Confirmación</title>
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

        .signature-line-l {
            position: absolute;
            right: 40px;
            width: 350px;
            margin-top: 90px !important;
            color: #3d69a8;
            text-align: right;
        }

        .signature-line-l hr {
            width: 100%;
            border-top: 1px solid #3d69a8;
        }

        .signature-line-l p {
            margin-top: 0px;
            margin-right: 150px;
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
        <img src="{{ public_path('assets/img/Cruz.png') }}" alt="Mercedes" class="logo cruzz">

        <div class="header">
            <span class="h2">Parroquia Nuestra Señora de Las Mercedes</span>
            <p class="subtitle">Diócesis de Jalapa</p>
            <p class="subtitle">Calle al Calvario, Barrio el Centro, Sanarate, El Progreso</p>
            <div class="title">CONSTANCIA DE CONFIRMACIÓN</div>
        </div>

        <div class="form-content">
            <div class="form-group" style="width: 20cm;">
                <label for="parroco">El infrascrito, Párroco de:</label>
                <span>{{ $confirmacion->nombre_parroquia_bautizo }}</span>
            </div>

            <p class="text-center" style="font-weight: 500; color: #3d6aa8de; font-size: 1.1rem;">
                Certifica que en el libro de Confirmaciones:
            </p>

            <div class="form-group">
                <label for="libro">No.:</label>
                <span>{{ $confirmacion->NoPartida }}</span>
                <label for="folio" style="margin-left: 10px;">Folio:</label>
                <span>{{ $confirmacion->folio }}</span>
                <label style="margin-left: 10px;">de esta Parroquia consta que:</label>
            </div>

            <div class="form-group">
                <span>{{ $confirmacion->personaConfirmada->nombres }}
                    {{ $confirmacion->personaConfirmada->apellidos }}</span>
            </div>

            <div class="form-group">
                <label for="padre">Hijo de</label>
                <span>{{ $confirmacion->padre?->nombres ?? ' ' }} {{ $confirmacion->padre?->apellidos ?? '' }}</span>
            </div>
            <div class="form-group">
                <label for="">y de</label>
                <span>{{ $confirmacion->madre?->nombres ?? ' ' }} {{ $confirmacion->madre?->apellidos ?? '' }}</span>
            </div>

            <div class="form-group">
                <label for="nacido">Nacido el</label>
                <span>{{ \Carbon\Carbon::parse($confirmacion->personaConfirmada->fecha_nacimiento)->locale('es')->isoFormat('D') }}</span>
                <label for="mes" style="margin-left: 5px;">de</label>
                <span>{{ \Carbon\Carbon::parse($confirmacion->personaConfirmada->fecha_nacimiento)->locale('es')->isoFormat('MMMM') }}</span>
                <label for="ano" style="margin-left: 5px;">del año</label>
                <span>{{ \Carbon\Carbon::parse($confirmacion->personaConfirmada->fecha_nacimiento)->locale('es')->isoFormat('Y') }}</span>
            </div>


            <div class="form-group">
                <label for="confirmado">Fue confirmado el</label>
                <span>{{ \Carbon\Carbon::parse($confirmacion->fecha_confirmacion)->format('d') }}</span>
                <label for="lugarConf">en</label>
                <span>{{ $confirmacion->nombre_parroquia_bautizo }}</span>
            </div>

            <div class="form-group">
                <label for="padre">Por el Excmo. Monseñor</label>
                <span>{{ $confirmacion->sacerdote->nombres }} {{ $confirmacion->sacerdote->apellidos }}</span>
            </div>

            <div class="form-group">
                <label for="adrin">Habiendo sido padrino y madrina:</label>
                <span>
                    {{ $confirmacion->padrino?->nombres ?? ' ' }} {{ $confirmacion->padrino?->apellidos ?? '' }}
                    y
                    {{ $confirmacion->madrina?->nombres ?? ' ' }} {{ $confirmacion->madrina?->apellidos ?? '' }}
                </span>
            </div>

            <div class="form-group date-group" style="margin-top: 50px ;">
                <span class="day">{{ now()->format('d') }}</span>
                <label>. de </label>
                <span class="month">{{ now()->locale('es')->isoFormat('MMMM') }}</span>
                <label>. de </label>
                <span class="year">{{ now()->format('Y') }}</span>
            </div>
        </div>
        <div class="signature-line-l">
            <hr>
            <p><strong>Parroco</strong></p>
        </div>
    </div>
</body>

</html>