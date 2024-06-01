<?php

use App\Http\Controllers\ProfileController;use App\Http\Controllers\Auth\RegisteredUserController;
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

// Agregar rutas modulados 
require __DIR__.'/auth.php';
require __DIR__.'/supervisor.php';
require __DIR__.'/alumno.php';
require __DIR__.'/admin.php';

Route::get('/', function () {
    return view('login');
});

Route::get('/registro', [RegisteredUserController::class, 'create'])->name('register.create');

Route::get('/preguntas_frecuentes', function () {
    return view('preguntas_frecuentes');
});