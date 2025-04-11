<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Persona extends Model
{
    use HasFactory;

    protected $table = 'personas';

    protected $primaryKey = 'persona_id';

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
        'madrina_id'
    ];

    public function casamientosEsposo()
    {
        return $this->hasMany(Casamiento::class, 'esposo_id', 'persona_id');
    }
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'municipio_id');
    }

    public function casamientosEsposa()
    {
        return $this->hasMany(Casamiento::class, 'esposa_id', 'persona_id');
    }

    public function testigos()
    {
        return $this->hasMany(Testigo::class, 'persona_id', 'persona_id');
    }
    // Relación para el padre
    public function padre()
    {
        return $this->belongsTo(self::class, 'padre_id');
    }

    // Relación para la madre
    public function madre()
    {
        return $this->belongsTo(self::class, 'madre_id');
    }

    // Relación para el padrino
    public function padrino()
    {
        return $this->belongsTo(self::class, 'padrino_id');
    }

    // Relación para la madrina
    public function madrina()
    {
        return $this->belongsTo(self::class, 'madrina_id');
    }


}
