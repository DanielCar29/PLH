<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\AdministradorGeneral;
use App\Models\Alumno;
use App\Models\Supervisor;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Se relaciona con las siguientes tablas:
    public function alumno()
    {
        return $this->hasOne(Alumno::class, 'usuario_id');
    }

    public function administradorGeneral()
    {
        return $this->hasOne(AdministradorGeneral::class, 'usuario_id'); // Cambiar 'usuario_id' si es diferente
    }
    
    public function supervisor()
    {
        return $this->hasOne(Supervisor::class, 'usuario_id');
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'apellido_paterno',
        'apellido_materno',
        'email',
        'password',
        'role',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}