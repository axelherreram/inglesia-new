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

    // Rutas para las personas
    Route::resource('personas', PersonasController::class);


    // Rutas para bautizos
    Route::get('/dashboard-bautizo-create', [BautizoController::class, 'create'])->name('bautizos.create');
    Route::post('/bautizos', [BautizoController::class, 'store'])->name('bautizos.store');
    Route::get('/municipios/{departamento_id}', [BautizoController::class, 'getMunicipios']);
    Route::get('/dashboard-list-bautizo', [BautizoController::class, 'index'])->name('bautizos.index');
    Route::get('/bautizos/{bautizo_id}', [BautizoController::class, 'show'])->name('bautizos.show');
    Route::put('/bautizos/{bautizo_id}', [BautizoController::class, 'update'])->name('bautizos.update');
    Route::get('/bautizo/{bautizo}/pdf', [BautizoController::class, 'generatePDF'])->name('bautizo.pdf');

    // Rutas para comuniones
    Route::get('/dashboard-comunion-create', [ComunionController::class, 'create'])->name('comuniones.create');
    Route::post('/comuniones', [ComunionController::class, 'store'])->name('comuniones.store');
    Route::get('/dashboard-list-comunion', [ComunionController::class, 'index'])->name('comuniones.index');
    Route::get('/comuniones/{comunion_id}', [ComunionController::class, 'show'])->name('comuniones.show');
    Route::put('/comuniones/{comunion_id}', [ComunionController::class, 'update'])->name('comuniones.update'); 
    Route::get('/municipios/{departamento_id}', [ComunionController::class, 'getMunicipios']);
    Route::get('/comunion/{comunion}/pdf', [ComunionController::class, 'generatePDF'])->name('comunion.pdf');


    // Rutas para confirmaciones
    Route::get('/dashboard-list-confirmacion', [ConfirmacionController::class, 'index'])->name('confirmaciones.index');
    Route::get('/dashboard-confirmacion-create', [ConfirmacionController::class, 'create'])->name('confirmaciones.create');
    Route::post('/confirmaciones', [ConfirmacionController::class, 'store'])->name('confirmaciones.store');
    Route::get('/confirmaciones/{confirmacion_id}', [ConfirmacionController::class, 'show'])->name('confirmaciones.show');
    Route::put('/confirmaciones/{confirmacion_id}', [ConfirmacionController::class, 'update'])->name('confirmaciones.update');
    Route::get('/confirmacion/{confirmacion}/pdf', [ConfirmacionController::class, 'generatePDF'])->name('confirmacion.pdf');

    // Rutas para casamientos
    Route::get('/dashboard-casamiento-create', [CasamientoController::class, 'create'])->name('casamientos.create');
    Route::post('/casamientos', [CasamientoController::class, 'store'])->name('casamientos.store');
    Route::get('/dashboard-list-casamiento', [CasamientoController::class, 'index'])->name('casamientos.index');
    Route::get('/casamientos/{casamiento_id}', [CasamientoController::class, 'show'])->name('casamientos.show');
    Route::put('/casamientos/{casamiento_id}', [CasamientoController::class, 'update'])->name('casamientos.update');
    Route::get('/casamiento/{casamiento}/pdf', [CasamientoController::class, 'generatePDF'])->name('casamiento.pdf');

    // Rutas para el perfil de usuario
    Route::get('/user-profile', [UserProfileController::class, 'show'])->name('user.profile');
    Route::put('/user-profile', [UserProfileController::class, 'update'])->name('user.update');
});

// Rutas para errores y autenticación adicional
Route::get('/auth-basic-forgot-password', function () {
    return view('auth-basic-forgot-password');
});

Route::get('/errors-404-error', function () {
    return view('errors-404-error');
});

Route::get('/errors-500-error', function () {
    return view('errors-500-error');
});
