<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use App\Providers\RouteServiceProvider;
use Tests\TestCase;

class RegistroSupervisorTest extends TestCase
{

    protected function setUp(): void
    {
        parent::setUp();

        // Ejecutar migraciones y semillas si es necesario
        Artisan::call('migrate:refresh', ['--seed' => true]);

        // Realizar el inicio de sesión antes de cada prueba
        $this->post(route('login'), [
            'email' => 'admin@gmail.com',
            'password' => '123456789',
        ]);
    }    

    public function test_visualiza_registro_supervisor_correctamente(){

        $cargar = $this->get('administrador.registro');
        $cargar->assertStatus(200);

    } 

    public function test_registra_supervisor_correctamente(){

        $registro = $this->post(route('registrarSupervisor'),[

            'nombre'=> 'Prueba Supervisor',
            'apellido_paterno'=> 'paterno',
            'apellido_materno'=> 'materno',
            'correoPart1' => 'prueba',
            'correoPart2' => 'gmail.com',
            'carrera' => 1,
            'passPart1' => '123456789',
            'passPart2' => '123456789',

        ]);

        $registro->assertStatus(302);

    }

}
