<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bautizo extends Model
{
    use HasFactory;

    // Definir la tabla asociada
    protected $table = 'bautizo';
    protected $primaryKey = 'bautizo_id'; // Establece la clave primaria

    // Campos que pueden ser asignados de manera masiva
    protected $fillable = [
        'dato_parroquia_id',
        'NoPartida',
        'folio',
        'fecha_bautizo',
        'nombre_persona_bautizada',
        'edad',
        'fecha_nacimiento',
        'aldea',
        'municipio_id',
        'departamento_id',
        'nombre_padre',
        'nombre_madre',
        'nombre_sacerdote',
        'nombre_padrino',
        'nombre_madrina',
        'margen',
    ];

    // Definir el valor predeterminado de 'dato_parroquia_id'
    protected $attributes = [
        'dato_parroquia_id' => 1, // Valor fijo de 'dato_parroquia_id'
    ];

    protected $casts = [
        'fecha_bautizo' => 'datetime',
        'fecha_nacimiento' => 'datetime',
    ];
    // Relación con la tabla 'DatoGeneralParroquia'
    public function parroquia()
    {
        return $this->belongsTo(DatoGeneralParroquia::class, 'dato_parroquia_id', 'dato_parroquia_id');
    }

    // Relación con la tabla 'Municipio'
    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id', 'municipio_id');
    }

    // Relación con la tabla 'Departamento'
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'departamento_id');
    }
}
