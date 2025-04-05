<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Confirmacion extends Model
{
    use HasFactory;

    // Definir el nombre de la tabla si es diferente del nombre por defecto
    protected $table = 'confirmacion';

    // Definir la clave primaria si es diferente de 'id'
    protected $primaryKey = 'confirmacion_id';

    // Si no estás utilizando timestamps, desactívalo
    public $timestamps = true;

    // Definir los campos que son asignables en masa
    protected $fillable = [
        'NoPartida',
        'folio',
        'fecha_confirmacion',
        'nombre_persona_confirmo',
        'nombre_persona_confirmada',
        'edad',
        'nombre_parroquia_bautizo',
        'nombre_padre',
        'nombre_madre',
        'nombre_persona_padrino',
        'nombre_persona_madrina',
        'dato_parroquia_id',
        'departamento_id',
        'municipio_id'
    ];
    protected $attributes = [
        'dato_parroquia_id' => 1, // Valor fijo de 'dato_parroquia_id'
    ];
    // Relaciones con otras tablas
    public function parroquia()
    {
        return $this->belongsTo(DatoGeneralParroquia::class, 'dato_parroquia_id');
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
