<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Auth\RegisteredUserController;
use App\Http\Controllers\Administrador\listaSolicitudes;
use App\Http\Controllers\MenuController;
use App\Http\Controllers\Auth\RecoverController;
use App\Http\Controllers\QrScannerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Agregar rutas modulados 
require __DIR__.'/auth.php';
require __DIR__.'/supervisor.php';
require __DIR__.'/alumno.php';
require __DIR__.'/admin.php';

Route::get('/404', function () {
    return view('/errors/404');
});

Route::get('/welcome', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


Route::get('/', function () {
    return view('login');
});

Route::get('/registro', [RegisteredUserController::class, 'create'])->name('register.create');

Route::get('/preguntas_frecuentes', function () {
    return view('preguntas_frecuentes');
});

Route::get('/qrscanner', [QrScannerController::class, 'showScanner'])->name('qrscanner');
Route::post('/register-usage', [QrScannerController::class, 'registerUsage'])->name('register.usage');

// Route::get('/recover', [RecoverController::class, 'showRecoverForm'])->name('recover.form');
// Route::post('/recover', [RecoverController::class, 'recover'])->name('recover');
// Route::get('/reset-password', [RecoverController::class, 'showResetPasswordForm'])->name('reset.password.form');
// Route::post('/reset-password', [RecoverController::class, 'resetPassword'])->name('reset.password');