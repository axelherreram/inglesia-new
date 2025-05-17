<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Municipio extends Model
{
    use HasFactory;

    // Nombre de la tabla
    protected $table = 'municipio';

    // Clave primaria
    protected $primaryKey = 'municipio_id';

    // Los campos que se pueden asignar de manera masiva
    protected $fillable = [
        'municipio',
        'departamento_id',
    ];

    // Relación: Un municipio pertenece a un departamento
    public function departamento()
    {
        return $this->belongsTo(Departamento::class, 'departamento_id', 'departamento_id');
    }

    // Relación: Un municipio puede tener muchos bautizos
    public function bautizos()
    {
        return $this->hasMany(Bautizo::class, 'municipio_id', 'municipio_id');
    }

    // Relación: Un municipio puede tener muchas comuniones
    public function comuniones()
    {
        return $this->hasMany(Comunion::class, 'municipio_id', 'municipio_id');
    }

    // Relación: Un municipio puede tener muchas confirmaciones
    public function confirmaciones()
    {
        return $this->hasMany(Confirmacion::class, 'municipio_id', 'municipio_id');
    }

    // Relación: Un municipio puede tener muchos casamientos
    public function casamientos()
    {
        return $this->hasMany(Casamiento::class, 'municipio_id', 'municipio_id');
    }
}
