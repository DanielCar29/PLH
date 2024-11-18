<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupervisorVisualizaReporte extends Model
{
    use HasFactory;

    protected $fillable = ['supervisor_id', 'reporte_id'];

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    public function reporte()
    {
        return $this->belongsTo(Reporte::class, 'reporte_id');
    }
}
