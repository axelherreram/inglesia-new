<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casamiento extends Model
{
    use HasFactory;

    protected $table = 'casamientos'; // Nombre de la tabla
    protected $primaryKey = 'casamiento_id'; // Si la clave primaria no es `id`, especifica el nombre
    public $timestamps = true; // Si estás utilizando timestamps (created_at, updated_at)

    protected $fillable = [
        'NoPartida',
        'folio',
        'fecha_casamiento',
        'origen_esposo',
        'feligresesposo',
        'origen_esposa',
        'feligresesposa',
        'esposo_id',
        'esposa_id',
        'sacerdote_id',
        'padre_esposo_id',
        'madre_esposo_id',
        'padre_esposa_id',
        'madre_esposa_id',
    ];

    // Relaciones
    public function esposo()
    {
        return $this->belongsTo(Persona::class, 'esposo_id');
    }

    public function esposa()
    {
        return $this->belongsTo(Persona::class, 'esposa_id');
    }

    public function sacerdote()
    {
        return $this->belongsTo(Persona::class, 'sacerdote_id');
    }

    public function padreEsposo()
    {
        return $this->belongsTo(Persona::class, 'padre_esposo_id');
    }

    public function madreEsposo()
    {
        return $this->belongsTo(Persona::class, 'madre_esposo_id');
    }

    public function padreEsposa()
    {
        return $this->belongsTo(Persona::class, 'padre_esposa_id');
    }

    public function madreEsposa()
    {
        return $this->belongsTo(Persona::class, 'madre_esposa_id');
    }

    // Relación con Testigos
    public function testigos()
    {
        return $this->hasMany(Testigo::class, 'casamiento_id');
    }
}