<?php
// app/Models/Confirmacion.php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmacion extends Model
{
    use HasFactory;

    protected $table = 'confirmacion'; // Nombre de la tabla
    protected $primaryKey = 'confirmacion_id'; // Si la clave primaria no es `id`, especifica el nombre
    public $timestamps = true; // Si estás utilizando timestamps (created_at, updated_at)

    protected $fillable = [
        'NoPartida',
        'folio',
        'fecha_confirmacion',
        'persona_confirmada_id',
        'nombre_parroquia_bautizo',
        'departamento_id',
        'municipio_id',
        'sacerdote_id',
        'padre_id',
        'madre_id',
        'padrino_id',
        'madrina_id',
    ];

    // Relaciones
    public function personaConfirmada()
    {
        return $this->belongsTo(Persona::class, 'persona_confirmada_id');
    }

    public function sacerdote()
    {
        return $this->belongsTo(Persona::class, 'sacerdote_id');
    }

    public function padre()
    {
        return $this->belongsTo(Persona::class, 'padre_id');
    }

    public function madre()
    {
        return $this->belongsTo(Persona::class, 'madre_id');
    }

    public function padrino()
    {
        return $this->belongsTo(Persona::class, 'padrino_id');
    }

    public function madrina()
    {
        return $this->belongsTo(Persona::class, 'madrina_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }
}