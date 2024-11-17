<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\alumnos;

class carreras extends Model
{
    use HasFactory;

    protected $table = 'carreras';

    public function carreras()
    {
        return $this->belongsToMany(Carreras::class, 'carreras_alumno', 'alumno_id', 'carreras_id');
    }
    protected $fillable = [
        'carrera',
    ];

}
