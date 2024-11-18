<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Carrera extends Model
{
    use HasFactory;

    protected $fillable = ['carrera'];

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'carreras_alumno');
    }

    public function supervisores()
    {
        return $this->belongsToMany(Supervisor::class, 'carreras_supervisor');
    }
}
