<?php

namespace Database\Factories;

use App\Models\Comunion;
use App\Models\DatoGeneralParroquia;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Database\Eloquent\Factories\Factory;

class ComunionFactory extends Factory
{
    protected $model = Comunion::class;

    public function definition(): array
    {
        return [
            'NoPartida' => $this->faker->numberBetween(1, 1000),
            'folio' => 'Folio-' . $this->faker->bothify('Folio-####'),
            'fecha_comunion' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'nombre_persona_participe' => $this->faker->name,
            'nombre_padre' => $this->faker->name('male'),
            'nombre_madre' => $this->faker->name('female'),
            'fecha_nacimiento' => $this->faker->dateTimeBetween('-40 years', '-10 years'),
            'dato_parroquia_id' => DatoGeneralParroquia::inRandomOrder()->first()->dato_parroquia_id,
            'municipio_id' => Municipio::inRandomOrder()->first()->municipio_id,
            'departamento_id' => Departamento::inRandomOrder()->first()->departamento_id,
        ];
    }
}
