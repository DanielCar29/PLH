<?php

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

Route::get('/', function () {
    return view('login');
});

Route::get('/registro', function () {
    return view('registro');
});

// Vistas de supervisor
Route::get('/supervisor.home', function () {
    return view('/supervisor/home');
});

Route::get('/supervisor.visualizar_solicitud', function () {
    return view('/supervisor/visualizar_solicitud');
});