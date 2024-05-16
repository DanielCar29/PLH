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

Route::get('/preguntas_frecuentes', function () {
    return view('preguntas_frecuentes');
});

// Vistas de supervisor
Route::get('/supervisor.home', function () {
    return view('/supervisor/home');
});



Route::get('/supervisor.visualizar_reporte', function () {
    return view('/supervisor/visualizar_reporte');
});


Route::get('/supervisor.visualizar_solicitud', function () {
    return view('/supervisor/visualizar_solicitud');
});

Route::get('/supervisor.ayuda', function () {
    return view('/supervisor/ayuda');
});

Route::get('/supervisor.perfil', function () {
    return view('/supervisor/perfil');
});


// Vistas de Alumno
Route::get('/alumno.home', function () {
    return view('/alumno/home');
});

Route::get('/alumno.solicitar_beca', function () {
    return view('/alumno/solicitar_beca');
});

Route::get('/alumno.formulario', function () {
    return view('/alumno/preguntas');
});

Route::get('/alumno.beca', function () {
    return view('/alumno/ver_beca');
});