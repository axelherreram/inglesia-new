<?php

namespace Database\Factories;

use App\Models\Bautizo;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\DatoGeneralParroquia;
use App\Models\Municipio;
use App\Models\Departamento;

class BautizoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'dato_parroquia_id' => DatoGeneralParroquia::inRandomOrder()->first()->dato_parroquia_id,
            'NoPartida' => $this->faker->numberBetween(1, 1000),
            'folio' => 'Folio-' . $this->faker->unique()->word(),
            'fecha_bautizo' => $this->faker->dateTime(),
            'nombre_persona_bautizada' => $this->faker->name(),
            'edad' => $this->faker->numberBetween(1, 100),
            'fecha_nacimiento' => $this->faker->dateTime(),
            'aldea' => $this->faker->city(),
            'municipio_id' => Municipio::inRandomOrder()->first()->municipio_id,
            'departamento_id' => Departamento::inRandomOrder()->first()->departamento_id,
            'nombre_padre' => 'Mr. ' . $this->faker->name(),
            'nombre_madre' => 'Mrs. ' . $this->faker->name(),
            'nombre_sacerdote' => 'Dr. ' . $this->faker->name(),
            'nombre_padrino' => 'Prof. ' . $this->faker->name(),
            'nombre_madrina' => $this->faker->name(),
            'margen' => $this->faker->sentence(),
        ];
    }
}
