<?php
namespace Database\Factories;

use App\Models\Casamiento;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Casamiento>
 */
class CasamientoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = Casamiento::class;

    public function definition(): array
    {
        return [
            'NoPartida' => $this->faker->word,
            'folio' => $this->faker->word,
            'fecha_casamiento' => $this->faker->date(),
            'nombres_testigos' => $this->faker->words(3, true), 
            'nombre_esposo' => $this->faker->name, // Nombre completo
            'edad_esposo' => $this->faker->numberBetween(18, 99), // Genera una edad entre 18 y 99
            'origen_esposo' => $this->faker->city, // Origen como ciudad
            'feligresesposo' => $this->faker->text(), // Valor opcional
            'nombre_padre_esposo' => $this->faker->name,
            'nombre_madre_esposo' => $this->faker->name,
            'nombre_esposa' => $this->faker->name, 
            'edad_esposa' => $this->faker->numberBetween(18, 99), // Genera una edad entre 18 y 99
            'origen_esposa' => $this->faker->city, // Origen como ciudad
            'feligresesposa' => $this->faker->text(),
            'nombre_padre_esposa' => $this->faker->name,
            'nombre_madre_esposa' => $this->faker->name,
            'nombre_parroco' => $this->faker->name,
            'dato_parroquia_id' => 1, // Fijo en 1
        ];
    }
}
