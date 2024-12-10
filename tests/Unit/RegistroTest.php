<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Carrera;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class RegistroTest1 extends TestCase
{
    //Test para módulo de registro

    use RefreshDatabase; 
    

    /** @test */
    public function la_pagina_de_registro_se_carga_correctamente()
    {
        $response = $this->get(route('register'));

        $response->assertStatus(200); // Código HTTP 200 significa que la página se cargó correctamente
        // $response->assertViewIs('auth.register'); // Verifica que se carga la vista correcta
    }

    /** @test */
    public function un_usuario_puede_registrarse_correctamente()
    {

        Artisan::call('migrate:refresh', [
            '--seed' => true,
        ]);
        

        $response = $this->post(route('register'), [
            'name' => 'Usuario de Prueba',
            'email' => 'usuario@prueba.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'apellido_paterno' => 'apellido_paterno',
            'apellido_materno' => 'apellido_materno',
            'numero_de_control' => '212312312',
            'semestre' => '7',
            'carrera' => 'ing. informatica',

        ]);

        $response->assertRedirect('/'); // Laravel redirige después del registro exitoso
        $this->assertDatabaseHas('users', ['email' => 'usuario@prueba.com']); // Verifica que el usuario fue creado en la base de datos
    }

    /** @test */
    public function el_registro_falla_si_faltan_campos_requeridos()
    {
        $response = $this->post(route('register'), [
            'name' => '',
            'email' => '',
            'password' => '',
        ]);

        $response->assertSessionHasErrors(['name', 'email', 'password']); // Verifica que los errores de validación se retornan
    }

    /** @test */
    public function el_registro_falla_si_el_email_ya_ha_sido_usado()
    {

        // Crea un usuario con un email existente
        User::factory()->create(['email' => 'usuario@prueba.com']);

        $response = $this->post(route('register'), [
            'name' => 'Usuario Nuevo',
            'email' => 'usuario@prueba.com',
            'password' => 'password123',
            'password_confirmation' => 'password123',
            'apellido_paterno' => 'apellido_paterno',
            'apellido_materno' => 'apellido_materno',
            'numero_de_control' => '212312312',
            'semestre' => '7',
            'carrera' => 'ing. informatica',
        ]);

        $response->assertSessionHasErrors(['email']); // Verifica que hay un error de email duplicado
    }

    /** @test */
    public function el_registro_falla_si_las_contrasenas_no_coinciden()
    {
        $response = $this->post(route('register'), [
            'name' => 'Usuario de Prueba',
            'email' => 'usuario@prueba.com',
            'password' => 'password123',
            'password_confirmation' => 'diferente123',
        ]);

        $response->assertSessionHasErrors(['password']); // Verifica que hay un error de validación para la contraseña
    }

}
