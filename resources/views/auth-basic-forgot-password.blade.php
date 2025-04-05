<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon-32x32.png" type="image/png" />
    <!-- loader-->
    <link href="assets/css/pace.min.css" rel="stylesheet" />
    <script src="assets/js/pace.min.js"></script>
    <!-- Bootstrap CSS -->
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/bootstrap-extended.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500&display=swap" rel="stylesheet">
    <link href="assets/css/app.css" rel="stylesheet">
    <link href="assets/css/icons.css" rel="stylesheet">
    <title>Recuperar contraseña - iglesia sansare</title>
	<link rel="shortcut icon" href="{{ asset('assets/icon/icon.ico') }}" type="image/x-icon">
	<link rel="stylesheet" href="{{ asset('assets/css/login.css') }}">

</head>

<body class="">
    <!-- wrapper -->
    <div class="wrapper">
        <div class="authentication-forgot d-flex align-items-center justify-content-center">
            <div class="card forgot-box" style="border: none !important">
                <div class="card-body">
                    <div class="p-3">
                        <div class="text-center">
                            <img src="assets/images/icons/forgot-2.png" width="100" alt="" />
                        </div>
                        <h4 class="mt-5 font-weight-bold">Has olvidado tu contraseña</h4>
                        <p class="text-muted">Ingrese su correo electrónico registrado para restablecer la contraseña</p>
                        <div class="my-4">
                            <label class="form-label">Correo Electronico</label>
                            <input type="text" class="form-control" placeholder="example@user.com" / style="border: 1px solid #1b1b1f !important;">
                        </div>
                        <div class="d-grid gap-2">
                            <button type="button" class="btn btn-primary-ig" >Enviar</button>
                             <a href="/" class="btn btn-light"><i class='bx bx-arrow-back me-1'></i>Regresar el inicio de sesión</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- end wrapper -->
</body>

</html>