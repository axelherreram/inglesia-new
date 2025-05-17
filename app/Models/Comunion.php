<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comunion extends Model
{
    use HasFactory;

    protected $table = 'comunion'; // Nombre de la tabla
    protected $primaryKey = 'comunion_id'; // Si la clave primaria no es `id`, especifica el nombre
    public $timestamps = true; // Si estás utilizando timestamps (created_at, updated_at)

    protected $fillable = [
        'NoPartida',
        'folio',
        'fecha_comunion',
        'persona_participe_id',
        'departamento_id',
        'municipio_id',
        'sacerdote_id',
        'padre_id',
        'madre_id',
    ];

    // Relaciones
    public function personaParticipe()
    {
        return $this->belongsTo(Persona::class, 'persona_participe_id');
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

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }
}