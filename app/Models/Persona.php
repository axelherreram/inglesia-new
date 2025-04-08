<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    protected $table = 'personas';

    protected $fillable = [
        'nombres',
        'apellidos',
        'dpi_cui',
        'municipio_id',
        'direccion',
        'fecha_nacimiento',
        'sexo',
        'num_telefono',
        'tipo_persona',
        'padre_id',
        'madre_id',
        'padrino_id',
        'madrina_id',
    ];
}
