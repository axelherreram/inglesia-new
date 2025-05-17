<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Recuperar contraseña - Iglesia Sansare</title>
    <link rel="shortcut icon" href="{{ asset('assets/icon/icon.ico') }}" type="image/x-icon">

    <!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;500;600;700&display=swap"
        rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">

    <!-- Line Icons -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <style>
        .back-button {
            color: #7f5539 !important;
            font-size: 14px;
            font-weight: 500;
            border: 1px solid #7f5539;
            padding: 6px 20px;
            border-radius: 8px
        }

        .back-button:hover {
            background-color: #7f5539 !important;
            color: white !important;
        }
    </style>

</head>

<body class="">
    <div class="wrapper">
        <div class="section-authentication-cover position-relative d-flex justify-content-center align-items-center">
            <div class="col-12 col-xl-7 col-xxl-5 d-flex align-items-center justify-content-center">
                <div class="card forgot-box rounded-2 m-3 shadow-none mb-0" style="border: none !important">
                    <div class="card-body p-sm-5">
                        <div class="text-center mb-4">
                            <h5 class="">Recuperar Contraseña</h5>
                            <p class="mb-0">Te enviaremos un enlace para restablecer tu contraseña</p>
                        </div>
                        <!-- Mensaje de éxito -->
                        @if (session('status'))
                            <div class="alert alert-success" role="alert">
                                {{ session('status') }}
                            </div>
                        @endif
                        <div class="form-body">
                            <form method="POST" class="row g-3" action="{{ route('password.email') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="email" class="form-label">Correo Electrónico</label>
                                    <div class="input-group" id="show_hide_password">
                                        <span class="input-group-text bg-transparent  border-end-0"
                                            style="border-color: #7f5539 !important">
                                            <i class="bx bx-envelope text-muted"></i>
                                        </span>
                                        <input type="email" name="email" class="form-control " id="email"
                                            style="border-color: #7f5539 !important" placeholder="ejemplo@correo.com"
                                            value="{{ old('email') }}" required>
                                    </div>
                                </div>
                                @if ($errors->has('email'))
                                    <div class="alert alert-danger mt-2">
                                        {{ $errors->first('email') }}
                                    </div>
                                @endif
                                <div class="col-12 d-flex justify-content-between align-items-center mt-4">
                                    <a href="{{ route('login') }}"
                                        class="back-button d-flex align-items-center text-decoration-none">
                                        <i class="lni lni-arrow-left me-2"></i>
                                        <span class="text-muted">Cancelar</span>
                                    </a>
                                    <button type="submit" class="btn btn-primary-ig col-12 col-md-6 mt-2 mt-md-0">Enviar
                                        Enlace</button>
                                </div>

                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>

    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>