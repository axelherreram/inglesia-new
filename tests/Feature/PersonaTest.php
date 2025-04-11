<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Persona;

class PersonaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function puede_crear_una_persona()
    {
        $persona = Persona::create([
            'nombres' => 'Juan',
            'apellidos' => 'Pérez',
            'dpi_cui' => '1234567890101',
            // 'municipio_id' => 1,
            'direccion' => 'Calle 123',
            'fecha_nacimiento' => '1990-01-01',
            'sexo' => 'M',
            'num_telefono' => '5551234567',
            'tipo_persona' => 'F'
        ]);

        $this->assertDatabaseHas('personas', [
            'nombres' => 'Juan',
            'apellidos' => 'Pérez'
        ]);
    }
}
