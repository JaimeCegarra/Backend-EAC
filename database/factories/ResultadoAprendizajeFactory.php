<?php

namespace Database\Factories;

use App\Models\ResultadoAprendizaje;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<ResultadoAprendizaje>
 */
// database/factories/ResultadoAprendizajeFactory.php

class ResultadoAprendizajeFactory extends Factory
{
    public function definition(): array
    {
        return [
            'modulo_id'       => \App\Models\Modulo::factory(),
            'codigo'          => 'RA' . $this->faker->unique()->numberBetween(1, 99),
            'descripcion'     => $this->faker->sentence(),
            // 'peso_porcentaje' => $this->faker->randomElement([25, 30, 35, 40]),
            // 'orden'           => $this->faker->numberBetween(1, 10),
        ];
    }
}
