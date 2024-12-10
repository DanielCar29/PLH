<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PerfilAdminTest extends TestCase
{
    protected function setUp(): void{
        parent::setUp();

        // Ejecutar migraciones y semillas si es necesario
        Artisan::call('migrate:refresh', ['--seed' => true]);

        // Realizar el inicio de sesión antes de cada prueba
        $this->post(route('login'), [
            'email' => 'admin@gmail.com',
            'password' => '123456789',
        ]);
    }

    public function test_visualiza_perfil_admin_correctamente(){

        $cargar = $this->get('administrador.perfil');
        $cargar->assertStatus(200);

    }

    public function test_actualiza_perfil_admin_correctamente(){

        $actualiza = $this->post(route('actualizarPerfil'),[

            'id_user'=>auth()->user()->id,
            'nombre' => 'prueba',
            'apellido_paterno' => 'Paterno',
            'apellido_materno' => 'Materno',
            'correo' => 'admin@gmail.com',
            'pass' => '',

        ]);

        $actualiza->assertStatus(302);

    }
}
