<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bautizo extends Model
{
    use HasFactory;

    protected $table = 'bautizo'; 
    protected $primaryKey = 'bautizo_id';
    public $timestamps = true; 

    protected $fillable = [
        'persona_bautizada_id',
        'NoPartida',
        'folio',
        'fecha_bautizo',
        'aldea',
        'municipio_id',
        'departamento_id',
        'sacerdote_id',
        'margen',
        'padre_id',
        'madre_id',
        'padrino_id',
        'madrina_id',
    ];

    // Relaciones
    public function personaBautizada()
    {
        return $this->belongsTo(Persona::class, 'persona_bautizada_id');
    }

    public function municipio()
    {
        return $this->belongsTo(Municipio::class, 'municipio_id');
    }

    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id');
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
}
