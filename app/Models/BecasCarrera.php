<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BecasCarrera extends Model
{
    use HasFactory;

    // Especifica el nombre de la tabla
    protected $table = 'becas_carrera';

    protected $fillable = [
        'carreras_id',
        'detalles_beca_id',
    ];

    // Relación con la tabla 'carreras'
    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carreras_id');
    }

    // Relación con la tabla 'detalles_becas'
    public function detallesBeca()
    {
        return $this->belongsTo(DetallesBeca::class, 'detalles_beca_id');
    }

    // Relación con la tabla 'becas'
    public function becas()
    {
        return $this->hasMany(Beca::class, 'becas_carrera_id');
    }
}
