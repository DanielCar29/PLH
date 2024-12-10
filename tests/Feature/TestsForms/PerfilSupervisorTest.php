<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Artisan;
use Tests\TestCase;

class PerfilSupervisorTest extends TestCase
{
    protected function setUp(): void{
        parent::setUp();

        // Ejecutar migraciones y semillas si es necesario
        Artisan::call('migrate:refresh', ['--seed' => true]);

        // Realizar el inicio de sesión antes de cada prueba
        $this->post(route('login'), [
            'email' => 'supervisor@gmail.com',
            'password' => '123456789',
        ]);
    }

    public function test_visualiza_perfil_supervisor_correctamente(){

        $cargar = $this->get('supervisor.perfil');
        $cargar->assertStatus(200);

    }

    public function test_actualiza_perfil_supervisor_correctamente(){

        $actualiza = $this->post(route('supervisor.actualiza_perfil'),[

            'id_supervisor'=>auth()->user()->id,
            'nombre' => 'prueba',
            'apellidoPaterno' => 'Paterno',
            'apellidoMaterno' => 'Materno',
            'correo' => 'supervisor@gmail.com',
            'pass' => '123456789',

        ]);

        $actualiza->assertStatus(302);

    }
}
