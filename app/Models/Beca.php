<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Beca extends Model
{
    use HasFactory;

    protected $fillable = [
        'fecha_de_autorizacion', 
        'codigo_qr', 
        'estado', 
        'becas_carrera_id'
    ];

    public function becasCarrera()
    {
        return $this->belongsTo(BecasCarrera::class, 'becas_carrera_id');
    }

    public function alumnos()
    {
        return $this->belongsToMany(Alumno::class, 'alumno_beca', 'beca_id', 'alumno_id');
    }
}
