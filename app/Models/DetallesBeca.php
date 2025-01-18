<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetallesBeca extends Model
{
    use HasFactory;

    protected $fillable = [
        'administrador_general_id',
        'estado_convocatoria',
        'inicio_convocatoria',
        'fin_convocatoria'
    ];

    public function administradorGeneral()
    {
        return $this->belongsTo(AdministradorGeneral::class, 'administrador_general_id');
    }
}
