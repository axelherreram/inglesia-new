<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!--plugins-->
    <link href="assets/plugins/simplebar/css/simplebar.css" rel="stylesheet" />
    <link href="assets/plugins/perfect-scrollbar/css/perfect-scrollbar.css" rel="stylesheet" />
    <link href="assets/plugins/metismenu/css/metisMenu.min.css" rel="stylesheet" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>Login - iglesia Sansare</title>
    <link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">
    <link rel="shortcut icon" href="{{ asset('assets/icon/icon.ico') }}" type="image/x-icon">
</head>

<body class="">
    <div class="wrapper">
        <div class="section-authentication-cover position-relative d-flex justify-content-center align-items-center">
            <div class="col-12 col-xl-7 col-xxl-5 d-flex align-items-center  justify-content-center ">
                <div class="card forgot-box rounded-2 m-3 shadow-none  mb-0" style="border: none !important">
                    <div class="card-body p-sm-5">
                        <div class="text-center mb-4">
                            <h5 class="">Iniciar Sesión</h5>
                            <p class="mb-0">Por favor inicia sesión en tu cuenta</p>
                        </div>
                        <!-- Mensaje de error de credenciales incorrectas -->
                        @if (session('error'))
                            <div class="alert alert-danger">
                                {{ session('error') }}
                            </div>
                        @endif
                        <div class="form-body">
                            <form method="POST" class="row g-3" action="{{ route('login.post') }}">
                                @csrf
                                <div class="col-12">
                                    <label for="inputEmailAddress" class="form-label">Correo Electrónico</label>
                                    <input type="email" name="email" class="form-control" id="inputEmailAddress"
                                        placeholder="Ingrese su correo electrónico" required>
                                </div>
                                <div class="col-12">
                                    <label for="inputChoosePassword" class="form-label">Contraseña</label>
                                    <div class="input-group " id="show_hide_password">
                                        <input type="password" name="password" class="form-control"
                                            id="inputChoosePassword" placeholder="Ingrese su contraseña" required>
                                        <a href="javascript:;" class="input-group-text bg-transparent ">
                                            <i class="bx bx-hide"></i>
                                        </a>
                                    </div>
                                </div>
                                <div class="col-md-6">

                                </div>
                                <div class="col-md-6 text-end">
                                    <a href="#">¿Olvidó la contraseña?</a>
                                </div>
                                <div class="col-12 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-primary-ig col-12 col-md-6">INICIAR
                                        SESIÓN</button>
                                </div>
                            </form>

                        </div>
                    </div>

                </div>

            </div>
            <div class="text-biblico">
                <span>Todo lo puedo en Cristo
                    que me fortalece <br>
                    Filipenses 4:13</span>
            </div>
        </div>
    </div>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <!--plugins-->
    <script src="assets/js/jquery.min.js"></script>
    <script src="assets/plugins/simplebar/js/simplebar.min.js"></script>
    <script src="assets/plugins/metismenu/js/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/js/perfect-scrollbar.js"></script>
    <!--Password show & hide js -->
    <script>
        $(document).ready(function() {
            $("#show_hide_password a").on('click', function(event) {
                event.preventDefault();
                if ($('#show_hide_password input').attr("type") == "text") {
                    $('#show_hide_password input').attr('type', 'password');
                    $('#show_hide_password i').addClass("bx-hide");
                    $('#show_hide_password i').removeClass("bx-show");
                } else if ($('#show_hide_password input').attr("type") == "password") {
                    $('#show_hide_password input').attr('type', 'text');
                    $('#show_hide_password i').removeClass("bx-hide");
                    $('#show_hide_password i').addClass("bx-show");
                }
            });
        });
    </script>
    <!--app JS-->
    <script src="assets/js/app.js"></script>
</body>

</html>
