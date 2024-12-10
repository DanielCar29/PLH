<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//Incorporar:
use Illuminate\Support\Facades\Artisan;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class RegistroTest extends TestCase
{

    public function test_registro_funciona_correctamente(){

        Artisan::call('migrate:refresh', [
            '--seed' => true,
        ]);        

        //Carga el formulario
        $carga = $this->get(route('register'));
        $carga->assertStatus(200)->assertSee('register');

    }

    public function test_no_realiza_registro_con_datos_incompletos(){

        //Validación de un envío de datos incompleto y que no cumplen
        $registro_no_valido = $this->post(route('register'),[
            "email" => "ejemploNoCumple",
            "password" => "1234"
        ]);
        $registro_no_valido->assertStatus(302);

    }

    public function test_no_realiza_registro_con_password_sin_formato(){

        //Validación de un envío de datos completo, pero que contrasenia no cumple
        $registro_valido = $this->post(route('register'),[

            'name' => 'Usuario de Prueba',
            'email' => 'usuario@prueba.com',
            'password' => '1234',
            'password_confirmation' => '1234',
            'apellido_paterno' => 'apellido_paterno',
            'apellido_materno' => 'apellido_materno',
            'numero_de_control' => '212312312',
            'semestre' => '7',
            'carrera' => 1,

        ]);
        
        $registro_valido->assertStatus(302);

    }

    public function test_registro_realiza_correctamente_el_registro(){


        //Validación de un envío de datos completo y que cumple
        $registro_valido = $this->post(route('register'),[

            'name' => 'Usuario de Prueba',
            'email' => 'usuario@prueba.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'apellido_paterno' => 'apellido_paterno',
            'apellido_materno' => 'apellido_materno',
            'numero_de_control' => '212312312',
            'semestre' => '7',
            'carrera' => 1,

        ]);
        $this->assertAuthenticated();
        //El registro es valido -> muestra el estado 302 (Redirección) -> Si redirige a '/'
        $registro_valido->assertValid('name','email','password','password_confirmation',
        'apellido_paterno','apellido_materno','numero_de_control','semestre','carrera');
        $registro_valido->assertStatus(302)->assertRedirect(RouteServiceProvider::HOME_ALUMNO);


    }

}
