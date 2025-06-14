@extends('layouts.app')

@section('style')
    <style>
        .profile-container {
            margin: 40px auto;
            max-width: 1000px;
        }

        .alert {
            border-radius: 8px;
            padding: 15px;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .alert-success {
            background-color: #d4edda;
            border-color: #c3e6cb;
            color: #155724;
        }

        .profile-avatar-container {
            display: flex;
            justify-content: center;
            margin-bottom: 20px;
        }



        .profile-avatar i {
            font-size: 40px;
            color: white;
        }

        .input-icon-wrapper {
            position: relative;
        }

        .password-toggle {
            position: absolute;
            right: 10px;
            top: 50%;
            transform: translateY(-50%);
            background: none;
            border: none;
            cursor: pointer;
            color: #6c757d;
            transition: color 0.2s ease;
            z-index: 10;
        }

        .password-toggle:hover {
            color: #6c5ce7;
        }

        .input-with-icon.password-input {
            padding-right: 40px;
        }

        .password-strength {
            height: 5px;
            border-radius: 5px;
            margin-top: 8px;
            background: #e9ecef;
            overflow: hidden;
        }

        .password-strength-meter {
            height: 100%;
            width: 0%;
            transition: width 0.3s ease;
        }

        .weak {
            width: 33%;
            background-color: #dc3545;
        }

        .medium {
            width: 66%;
            background-color: #ffc107;
        }

        .strong {
            width: 100%;
            background-color: #28a745;
        }
    </style>
@endsection

@section('wrapper')
    <div class="page-wrapper">
        <div class="page-content">
            <div class="profile-container">
                <div class="row">
                    <div class="col-lg-12 mb-4">
                        <h1 class="text-center mb-4">Mi Cuenta</h1>
                        <p class="text-center text-muted">Administra tu información personal y seguridad</p>
                    </div>

                    <div class="col-lg-6">
                        <!-- Tarjeta de perfil -->
                        <div class="card">
                            <div class="form-header">
                                <div class="profile-avatar-container">
                                    <div class="profile-avatar">
                                        <i class="lni lni-user"></i>
                                    </div>
                                </div>
                                <h2 class="card-title text-center">Información Personal</h2>
                                <p class="card-subtitle text-center">Actualiza tus datos personales</p>
                            </div>

                            <div class="card-body">
                                <!-- Formulario para actualizar el perfil -->
                                <form action="{{ route('user.update') }}" method="POST" id="profile-form">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="lni lni-user"></i> Nombres
                                                </label>
                                                <div class="input-icon-wrapper">
                                                    <input type="text" class="form-control input-with-icon" name="nombres"
                                                        value="{{ old('nombres', $user->nombres) }}" required>
                                                </div>
                                                @error('nombres')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="form-label">
                                                    <i class="lni lni-user"></i> Apellidos
                                                </label>
                                                <div class="input-icon-wrapper">
                                                    <input type="text" class="form-control input-with-icon" name="apellidos"
                                                        value="{{ old('apellidos', $user->apellidos) }}" required>
                                                </div>
                                                @error('apellidos')
                                                    <div class="text-danger mt-1">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="lni lni-envelope"></i> Email
                                        </label>
                                        <div class="input-icon-wrapper">
                                            <input type="email" class="form-control input-with-icon" name="email" readonly
                                                value="{{ old('email', $user->email) }}">
                                        </div>
                                        <div class="form-hint">El email no puede ser modificado</div>
                                    </div>

                                    <div class="form-group mb-0 text-end">
                                        <button type="submit" class="btn btn-primary" id="profile-submit-btn">
                                            <i class="lni lni-save"></i> Guardar Cambios
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-6">
                        <!-- Tarjeta de cambio de contraseña -->
                        <div class="card">
                            <div class="form-header">
                                <div class="profile-avatar-container">
                                    <div class="profile-avatar">
                                        <i class="lni lni-lock-alt"></i>
                                    </div>
                                </div>
                                <h2 class="card-title text-center">Seguridad</h2>
                                <p class="card-subtitle text-center">Actualiza tu contraseña de acceso</p>
                            </div>

                            <div class="card-body">
                                <form action="{{ route('user.changePassword') }}" method="POST" id="password-form">
                                    @csrf
                                    <input type="hidden" name="_method" value="PUT">

                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="lni lni-lock-alt"></i> Contraseña Actual
                                        </label>
                                        <div class="input-icon-wrapper">
                                            <input type="password" class="form-control input-with-icon password-input"
                                                name="current_password" id="current_password" required>
                                            <button type="button" class="password-toggle" data-target="current_password">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                        </div>
                                        @error('current_password')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="lni lni-lock-alt"></i> Nueva Contraseña
                                        </label>
                                        <div class="input-icon-wrapper">
                                            <input type="password" class="form-control input-with-icon password-input"
                                                name="new_password" id="new_password" required>
                                            <button type="button" class="password-toggle" data-target="new_password">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                        </div>
                                        <div class="password-strength mt-2">
                                            <div class="password-strength-meter" id="password-meter"></div>
                                        </div>
                                        <div class="form-hint" id="password-hint">La contraseña debe tener al menos 8
                                            caracteres y contener letras y números</div>
                                        @error('new_password')
                                            <div class="text-danger mt-1">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label class="form-label">
                                            <i class="lni lni-lock-alt"></i> Confirmar Nueva Contraseña
                                        </label>
                                        <div class="input-icon-wrapper">
                                            <input type="password" class="form-control input-with-icon password-input"
                                                name="new_password_confirmation" id="confirm_password" required>
                                            <button type="button" class="password-toggle" data-target="confirm_password">
                                                <i class="lni lni-eye"></i>
                                            </button>
                                        </div>
                                        <div class="form-hint" id="match-hint"></div>
                                    </div>

                                    <div class="form-group mb-0 text-end">
                                        <button type="submit" class="btn btn-primary" id="password-submit-btn">
                                            <i class="lni lni-save"></i> Cambiar Contraseña
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <!-- SweetAlert JS -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function () {
            // Configuración para mostrar/ocultar contraseñas
            const passwordToggles = document.querySelectorAll('.password-toggle');

            passwordToggles.forEach(toggle => {
                toggle.addEventListener('click', function () {
                    const targetId = this.getAttribute('data-target');
                    const passwordInput = document.getElementById(targetId);
                    const icon = this.querySelector('i');

                    if (passwordInput.type === 'password') {
                        passwordInput.type = 'text';
                        icon.classList.remove('lni-eye');
                        icon.classList.add('lni-eye-off');
                    } else {
                        passwordInput.type = 'password';
                        icon.classList.remove('lni-eye-off');
                        icon.classList.add('lni-eye');
                    }
                });
            });

            // Configuración de SweetAlert para el formulario de perfil
            const profileForm = document.getElementById('profile-form');
            const profileSubmitBtn = document.getElementById('profile-submit-btn');

            if (profileForm && profileSubmitBtn) {
                profileForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    Swal.fire({
                        title: '¿Actualizar información?',
                        text: "¿Estás seguro de que deseas actualizar tu información personal?",
                        icon: 'question',
                        showCancelButton: true,
                        confirmButtonColor: '#6c5ce7',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, actualizar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Mostrar indicador de carga
                            Swal.fire({
                                title: 'Actualizando...',
                                text: 'Espera un momento mientras actualizamos tu información',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Enviar el formulario
                            this.submit();
                        }
                    });
                });
            }

            // Configuración de SweetAlert para el formulario de cambio de contraseña
            const passwordForm = document.getElementById('password-form');
            const passwordSubmitBtn = document.getElementById('password-submit-btn');

            if (passwordForm && passwordSubmitBtn) {
                passwordForm.addEventListener('submit', function (e) {
                    e.preventDefault();

                    // Verificar que las contraseñas coincidan
                    const newPassword = document.getElementById('new_password').value;
                    const confirmPassword = document.getElementById('confirm_password').value;

                    if (newPassword !== confirmPassword) {
                        Swal.fire({
                            title: 'Error',
                            text: 'Las contraseñas no coinciden',
                            icon: 'error',
                            confirmButtonColor: '#6c5ce7'
                        });
                        return;
                    }

                    // Verificar que la contraseña tenga al menos 8 caracteres
                    if (newPassword.length < 8) {
                        Swal.fire({
                            title: 'Error',
                            text: 'La contraseña debe tener al menos 8 caracteres',
                            icon: 'error',
                            confirmButtonColor: '#6c5ce7'
                        });
                        return;
                    }

                    Swal.fire({
                        title: '¿Cambiar contraseña?',
                        text: "Esta acción cambiará tu contraseña de acceso",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#6c5ce7',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Sí, cambiar',
                        cancelButtonText: 'Cancelar'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Mostrar indicador de carga
                            Swal.fire({
                                title: 'Actualizando...',
                                text: 'Espera un momento mientras actualizamos tu contraseña',
                                allowOutsideClick: false,
                                didOpen: () => {
                                    Swal.showLoading();
                                }
                            });

                            // Enviar el formulario
                            this.submit();
                        }
                    });
                });
            }

            // Código para el medidor de fortaleza de contraseña
            const passwordInput = document.getElementById('new_password');
            const confirmInput = document.getElementById('confirm_password');
            const passwordMeter = document.getElementById('password-meter');
            const passwordHint = document.getElementById('password-hint');
            const matchHint = document.getElementById('match-hint');

            if (passwordInput && passwordMeter) {
                passwordInput.addEventListener('input', function () {
                    const password = this.value;
                    let strength = 0;

                    // Reducir requisitos de seguridad
                    if (password.length >= 6) strength += 1; // Reducido a 6 caracteres
                    if (password.match(/[a-zA-Z]/)) strength += 1; // Solo requiere letras
                    if (password.match(/\d/)) strength += 1; // Números opcionales

                    // Actualizar el medidor de fortaleza
                    passwordMeter.className = 'password-strength-meter';

                    if (password.length === 0) {
                        passwordMeter.style.width = '0%';
                        passwordHint.textContent = 'La contraseña debe tener al menos 6 caracteres';
                    } else if (strength < 2) {
                        passwordMeter.classList.add('weak');
                        passwordHint.textContent = 'Contraseña débil';
                    } else {
                        passwordMeter.classList.add('strong');
                        passwordHint.textContent = 'Contraseña aceptable';
                    }

                    // Verificar coincidencia si hay texto en ambos campos
                    if (confirmInput.value.length > 0) {
                        checkPasswordMatch();
                    }
                });
            }

            if (confirmInput && matchHint) {
                confirmInput.addEventListener('input', checkPasswordMatch);

                function checkPasswordMatch() {
                    if (passwordInput.value === confirmInput.value) {
                        matchHint.textContent = 'Las contraseñas coinciden';
                        matchHint.style.color = '#28a745';
                    } else {
                        matchHint.textContent = 'Las contraseñas no coinciden';
                        matchHint.style.color = '#dc3545';
                    }
                }
            }

            // Mostrar SweetAlert para mensajes de éxito o error
            @if (session('success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: "{{ session('success') }}",
                    icon: 'success',
                    confirmButtonColor: '#6c5ce7'
                });
            @endif

            @if (session('password_success'))
                Swal.fire({
                    title: '¡Éxito!',
                    text: "{{ session('password_success') }}",
                    icon: 'success',
                    confirmButtonColor: '#6c5ce7'
                });
            @endif

            @if (session('error'))
                Swal.fire({
                    title: 'Error',
                    text: "{{ session('error') }}",
                    icon: 'error',
                    confirmButtonColor: '#6c5ce7'
                });
            @endif
            });
    </script>
@endsection