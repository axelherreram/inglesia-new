<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Restablecer Contraseña</title>
    <link href="{{ asset('assets/css/bootstrap.min.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('assets/css/login.css') }}" rel="stylesheet">
    <!-- Line Icons -->
    <link href="{{ asset('assets/css/icons.css') }}" rel="stylesheet">
</head>

<body>
    <div class="wrapper">
        <div class="section-authentication-cover position-relative d-flex justify-content-center align-items-center min-vh-100">
            <div class="col-12 col-md-8 col-lg-6 col-xl-4">
                <div class="card rounded-3 shadow-lg border-0">
                    <div class="card-body p-5">
                        <div class="text-center mb-4">
                            <h5 class="mb-3">Restablecer Contraseña</h5>
                            <p class="text-muted">Ingresa tu nueva contraseña para continuar</p>
                        </div>

                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf
                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="mb-3">
                                <label for="email" class="form-label">Correo Electrónico</label>
                                <div class="input-group">
                                    <span class="input-group-text bg-transparent border-end-0" style="border-color: #7f5539 !important">
                                        <i class="bx bx-envelope text-muted"></i>
                                    </span>
                                    <input type="email" name="email" class="form-control" id="email" value="{{ old('email') }}" required autofocus>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password" class="form-label">Nueva Contraseña</label>
                                <div class="input-group" id="password-group">
                                    <span class="input-group-text bg-transparent border-end-0" style="border-color: #7f5539 !important">
                                        <i class="lni lni-lock-alt"></i>
                                    </span>
                                    <input type="password" name="password" class="form-control" id="password" required>
                                    <span class="input-group-text bg-transparent" style="cursor: pointer;" onclick="togglePassword('password')">
                                        <i class="lni lni-eye" id="eye-icon-password"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="password_confirmation" class="form-label">Confirmar Contraseña</label>
                                <div class="input-group" id="password-confirmation-group">
                                    <span class="input-group-text bg-transparent border-end-0" style="border-color: #7f5539 !important">
                                        <i class="lni lni-lock-alt"></i>
                                    </span>
                                    <input type="password" name="password_confirmation" class="form-control" id="password_confirmation" required>
                                    <span class="input-group-text bg-transparent" style="cursor: pointer;" onclick="togglePassword('password_confirmation')">
                                        <i class="lni lni-eye" id="eye-icon-password-confirmation"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary-ig col-12">Restablecer Contraseña</button>
                            </div>
                        </form>
                        <div class="d-grid mt-3">
                            <a href="{{ route('login') }}" class="btn btn-secondary col-12">Cancelar</a>
                        </div>
                        @if ($errors->any())
                            <div class="alert alert-danger mt-3">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
    <script>
        // Función para mostrar/ocultar la contraseña
        function togglePassword(id) {
            var passwordField = document.getElementById(id);
            var icon = document.getElementById('eye-icon-' + id);
            if (passwordField.type === "password") {
                passwordField.type = "text";
                icon.classList.remove('lni-eye');
                icon.classList.add('lni-eye-off');
            } else {
                passwordField.type = "password";
                icon.classList.remove('lni-eye-off');
                icon.classList.add('lni-eye');
            }
        }
    </script>
</body>

</html>
