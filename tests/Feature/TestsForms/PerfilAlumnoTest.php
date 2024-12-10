<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class PerfilAlumnoTest extends TestCase
{
    protected function setUp(): void{
        parent::setUp();

        // Ejecutar migraciones y semillas si es necesario
        Artisan::call('migrate:refresh', ['--seed' => true]);

        // Realizar el inicio de sesión antes de cada prueba
        $this->post(route('login'), [
            'email' => 'alumno1@gmail.com',
            'password' => '123456789',
        ]);
    }

    public function test_visualiza_perfil_alumno_correctamente(){

        $cargar = $this->get('alumno.perfil');
        $cargar->assertStatus(200);

    }

    public function test_actualiza_perfil_alumno_correctamente(){

        $userId = auth()->user()->id;

        // Verifica que el ID del usuario se esté obteniendo correctamente
        $this->assertNotNull($userId, 'El ID del usuario autenticado no se obtuvo correctamente');
    
        // Genera la URL manualmente para inspeccionar que el parámetro se esté pasando
        $url = route('alumno.actualizaPerfil', ['id' => $userId]);
        $this->assertStringContainsString((string) $userId, $url, 'El ID no se incluye correctamente en la URL');
    
        // Realiza la solicitud POST
        $actualiza = $this->post($url, [
            'nombre' => 'prueba',
            'apellido_paterno' => 'Paterno',
            'apellido_materno' => 'Materno',
            'correo' => 'alumno@gmail.com',
            'pass' => '', // Campo opcional
            'numero_control' => '1234567',
            'semestre' => '5',
        ]);
    
        $actualiza->assertStatus(302);

    }
}
