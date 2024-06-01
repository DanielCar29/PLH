<?php

use App\Http\Controllers\ProfileController;use App\Http\Controllers\Auth\RegisteredUserController;
use Illuminate\Support\Facades\Route;

// Vistas Alumno ---------------------------------------------------------------------------------------------------------
// | 
// |

Route::group(['middleware' => ['auth','checkAlumno']], function(){

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

    Route::get('/alumno.perfil', function () {
        return view('/alumno/perfil');
    });

});
