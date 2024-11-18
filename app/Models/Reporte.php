<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = 'reportes';

    protected $fillable = [
        'titulo',
        'contenido',
        'fecha',
        'id_supervisor',
    ];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'id_supervisor');
    }
}
