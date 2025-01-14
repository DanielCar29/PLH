<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdministradorGeneral extends Model
{
    use HasFactory;

    // Si el nombre de la tabla no sigue la convención plural
    protected $table = 'administradores_generales';

    // Si deseas que los timestamps se utilicen automáticamente
    public $timestamps = true;

    // Definir la relación con el modelo User
    public function user()
{
    return $this->belongsTo(User::class, 'usuario_id'); // Cambiar 'usuario_id' si es diferente
}

}
