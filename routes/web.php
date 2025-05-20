<?php

use App\Http\Controllers\Auth\LoginController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BautizoController;
use App\Http\Controllers\ComunionController;
use App\Http\Controllers\ConfirmacionController;
use App\Http\Controllers\CasamientoController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\UserProfileController;
use App\Http\Controllers\PersonasController;
use App\Http\Controllers\MunicipioController;
use App\Http\Controllers\Auth\ForgotPasswordController;
use App\Http\Controllers\Auth\ResetPasswordController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Ruta para mostrar el formulario de login
Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('dashboard');
    }
    return view('login-app');
})->name('login');

// Ruta para procesar el login (POST)
Route::post('login', [LoginController::class, 'login'])->name('login.post');
// Ruta para cerrar sesión (POST)
Route::post('logout', [LoginController::class, 'logout'])->name('logout');

// Rutas protegidas para el dashboard y demás funcionalidades
Route::middleware(['auth'])->group(function () {

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

    // Rutas para la gestión de usuarios
    Route::resource('personas', PersonasController::class)->except(['destroy']);
    Route::get('/personas/buscar', [PersonasController::class, 'buscarPersonas'])->name('personas.buscar');

    // routes/web.php
    // Rutas para la gestión de 

    Route::get('/municipios/{departamento_id}', [MunicipioController::class, 'getMunicipios']);
    // Rutas para bautizos

    Route::resource('bautizos', BautizoController::class);
    Route::get('/municipios/{departamento_id}', [BautizoController::class, 'getMunicipios']);
    Route::get('/bautizo/{bautizo}/pdf', [BautizoController::class, 'generatePDF'])->name('bautizo.pdf');

    // Rutas para comuniones
    Route::resource('comuniones', ComunionController::class);
    Route::get('/municipios/{departamento_id}', [ComunionController::class, 'getMunicipios']);
    Route::get('/comuniones/{comunion}/pdf', [ComunionController::class, 'generatePDF'])->name('comuniones.pdf');

    // Rutas para confirmaciones
    Route::resource('confirmaciones', ConfirmacionController::class);
    Route::get('/municipios/{departamento_id}', [ConfirmacionController::class, 'getMunicipios']);
    Route::get('/confirmaciones/{confirmacion}/pdf', [ConfirmacionController::class, 'generatePDF'])->name('confirmaciones.pdf');

    // Rutas para casamientos
    Route::resource('casamientos', CasamientoController::class);
    Route::get('/casamientos/{casamiento_id}/pdf', [CasamientoController::class, 'generatePDF'])->name('casamientos.pdf');
    Route::get('/api/personas/{persona}', [PersonasController::class, 'showJson'])->name('personas.showJson');
    
    
    // Ruta para eliminar un testigo
    Route::delete('/casamientos/testigos/{testigo_id}', [CasamientoController::class, 'destroy'])
        ->name('casamientos.testigos.destroy');

    // Rutas para el perfil de usuario
    Route::get('/user-profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::put('/user-profile', [UserProfileController::class, 'update'])->name('user.update');
    Route::put('/user-profile/change-password', [UserProfileController::class, 'changePassword'])->name('user.changePassword');
});


Route::get('password/reset/{token}', [ResetPasswordController::class, 'showResetForm'])->name('password.reset');
Route::post('/password/email', [ForgotPasswordController::class, 'sendResetLinkEmail'])->name('password.email');
Route::post('/password/reset', [ResetPasswordController::class, 'reset']);
Route::get('password/reset', [ForgotPasswordController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('password/reset', [ResetPasswordController::class, 'reset'])->name('password.update');

Route::get('/errors-404-error', function () {
    return view('errors-404-error');
});

Route::get('/errors-500-error', function () {
    return view('errors-500-error');
});