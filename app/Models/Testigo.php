<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Testigo extends Model
{
    use HasFactory;

    protected $table = 'testigos';

    protected $primaryKey = 'testigo_id';

    protected $fillable = [
        'casamiento_id', 
        'persona_id'
    ];

    public function casamiento()
    {
        return $this->belongsTo(Casamiento::class, 'casamiento_id', 'casamiento_id');
    }

    public function persona()
    {
        return $this->belongsTo(Persona::class, 'persona_id', 'persona_id');
    }
}