<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
//Incorporar:
use Illuminate\Support\Facades\Artisan;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class AutenticacionTest extends TestCase
{

    public function test_visualiza_login_correctamente(){

        Artisan::call('migrate:refresh', [
            '--seed' => true,
        ]);   

        $cargar = $this->get('/');
        $cargar->assertStatus(200);

    }

    public function test_se_autentica_correctamente_alumno_y_logout(){

        //Acceso correcto
        $acceso_correcto = $this->post(route('login'),[

            "email"=>"alumno1@gmail.com",
            "password"=>'123456789',

        ]);
        $acceso_correcto->assertStatus(302)->assertRedirect(RouteServiceProvider::HOME_ALUMNO);
        $logout = $this->post(route('logout'));
        $logout->assertStatus(302)->assertRedirect('/');

    }

    public function test_se_autentica_correctamente_supervisor_y_logout(){

        //Acceso correcto
        $acceso_correcto = $this->post(route('login'),[

            "email"=>"supervisor@gmail.com",
            "password"=>'123456789',

        ]);
        $acceso_correcto->assertStatus(302)->assertRedirect(RouteServiceProvider::HOME_SUPERVISOR);
        $logout = $this->post(route('logout'));
        $logout->assertStatus(302)->assertRedirect('/');

    }

    public function test_se_autentica_correctamente_admin_y_logout(){

        //Acceso correcto
        $acceso_correcto = $this->post(route('login'),[

            "email"=>"admin@gmail.com",
            "password"=>'123456789',

        ]);
        $acceso_correcto->assertStatus(302)->assertRedirect(RouteServiceProvider::HOME_ADMIN);
        $logout = $this->post(route('logout'));
        $logout->assertStatus(302)->assertRedirect('/');

    }

    public function test_no_se_autentica_si_datos_incorrectos(){

        //Acceso incorrecto
        $acceso_correcto = $this->post(route('login'),[

            "email"=>"incorrecto@gmail.com",
            "password"=>'123456789',

        ]);
        $acceso_correcto->assertStatus(302)->assertRedirect('/');

    }

}
