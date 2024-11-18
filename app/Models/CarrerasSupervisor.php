<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CarrerasSupervisor extends Model
{
    use HasFactory;

    protected $table = 'carreras_supervisor';

    protected $fillable = [
        'supervisor_id',
        'carreras_id',
    ];

    public $timestamps = false;

    public function supervisor()
    {
        return $this->belongsTo(Supervisor::class, 'supervisor_id');
    }

    public function carrera()
    {
        return $this->belongsTo(Carrera::class, 'carreras_id');
    }
}
