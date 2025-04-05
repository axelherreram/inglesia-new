<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Casamiento extends Model
{
    use HasFactory;

    // Tabla asociada
    protected $table = 'casamiento';

    // Clave primaria
    protected $primaryKey = 'casamiento_id';

    // Desactivar timestamps si no los necesitas
    public $timestamps = true;

    // Campos que se pueden asignar masivamente
    protected $fillable = [
        'NoPartida',
        'folio',
        'fecha_casamiento',
        'nombres_testigos',
        'nombre_esposo',
        'edad_esposo',
        'origen_esposo',
        'feligresesposo',
        'nombre_padre_esposo',
        'nombre_madre_esposo',
        'nombre_esposa',
        'edad_esposa',
        'origen_esposa',
        'feligresesposa',
        'nombre_padre_esposa',
        'nombre_madre_esposa',
        'nombre_parroco',
        'dato_parroquia_id'
    ];
    protected $attributes = [
        'dato_parroquia_id' => 1, // Valor fijo de 'dato_parroquia_id'
    ];
    // Definir relaciones, si es necesario
    public function parroquia()
    {
        return $this->belongsTo(DatoGeneralParroquia::class, 'dato_parroquia_id');
    }
}
