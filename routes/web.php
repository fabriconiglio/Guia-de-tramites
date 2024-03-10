<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AreaController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('/login');
});

// Activa la opción de verificación
Auth::routes(['verify' => true]);

// Asegúrate de que la ruta /home use el middleware 'verified' para requerir verificación de correo electrónico
Route::get('/home', [HomeController::class, 'index'])->name('home')->middleware(['verified', 'forceChangePassword']);


// Ruta para mostrar el formulario de cambio de contraseña
Route::get('/password/change', function () {
    return view('auth.passwords.change');
})->name('password.change.view')->middleware('auth', 'forceChangePassword');

// Ruta para procesar la solicitud de cambio de contraseña
Route::post('/password/update', [ChangePasswordController::class, 'update'])->name('password.forceUpdate');

// Rutas para el módulo de usuarios
Route::middleware(['is_admin'])->group(function () {
    Route::get('/users', [UserController::class, 'index'])->name('users.index');
    Route::resource('users', UserController::class);
    Route::resource('areas', AreaController::class);

});



