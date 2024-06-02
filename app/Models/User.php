<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Models\administradores_general;
use App\Models\alumnos;
use App\Models\supervisores;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    // Se relaciona con las siguientes tablas:

    
    public function alumno()
    {
        return $this->hasOne(alumnos::class, 'usuario_id');
        
    }

    public function administradorGeneral()
    {
        return $this->hasOne(administradores_general::class);
    }

    public function supervisor()
    {
        return $this->hasOne(supervisores::class);
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
