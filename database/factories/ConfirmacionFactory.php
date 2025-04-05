<?php

namespace Database\Factories;

use App\Models\Confirmacion;
use App\Models\Departamento;
use App\Models\Municipio;
use Illuminate\Database\Eloquent\Factories\Factory;
use Faker\Generator as Faker;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Confirmacion>
 */
class ConfirmacionFactory extends Factory
{
    protected $model = Confirmacion::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'NoPartida' => $this->faker->unique()->numerify('####'),
            'folio' => $this->faker->unique()->numerify('FOLIO-###'),
            'fecha_confirmacion' => $this->faker->dateTimeBetween('-10 years', 'now'),
            'nombre_persona_confirmo' => $this->faker->name,
            'nombre_persona_confirmada' => $this->faker->name,
            'edad' => $this->faker->numberBetween(12, 50),
            'nombre_parroquia_bautizo' => $this->faker->company,
            'nombre_padre' => $this->faker->name('male'),
            'nombre_madre' => $this->faker->name('female'),
            'nombre_persona_padrino' => $this->faker->name('male'),
            'nombre_persona_madrina' => $this->faker->name('female'),
            'dato_parroquia_id' => 1, // Ajustar según los datos de la relación
            'departamento_id' => Departamento::inRandomOrder()->first()->departamento_id,
            'municipio_id' => Municipio::inRandomOrder()->first()->municipio_id,
        ];
    }
}
