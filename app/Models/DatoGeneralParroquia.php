<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DatoGeneralParroquia extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'dato_general_parroquia';

    // Llave primaria
    protected $primaryKey = 'dato_parroquia_id';

    // Campos asignables masivamente
    protected $fillable = [
        'nombre_parroquia',
        'direccion',
        'num_telefono',
    ];

    // Relación con la tabla Bautizo
    public function bautizos()
    {
        return $this->hasMany(Bautizo::class, 'dato_parroquia_id', 'dato_parroquia_id');
    }

    // Relación con la tabla Comunion
    public function comuniones()
    {
        return $this->hasMany(Comunion::class, 'dato_parroquia_id', 'dato_parroquia_id');
    }

    // Relación con la tabla Confirmacion
    public function confirmaciones()
    {
        return $this->hasMany(Confirmacion::class, 'dato_parroquia_id', 'dato_parroquia_id');
    }

    // Relación con la tabla Casamiento
    public function casamientos()
    {
        return $this->hasMany(Casamiento::class, 'dato_parroquia_id', 'dato_parroquia_id');
    }
}
