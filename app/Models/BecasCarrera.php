<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BecasCarrera extends Model
{
    use HasFactory;

    protected $table = 'becas_carrera';
    protected $fillable = [
        'carreras_id', 
        'detalles_beca_id', 
        'cantidad_de_becas',
        'limite_solicitudes' // Nuevo campo
    ];

    // Relación con Carrera
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carreras_id');
    }

    // Relación con DetallesBeca
    public function detallesBeca()
    {
        return $this->belongsTo(DetallesBeca::class, 'detalles_beca_id');
    }
}
