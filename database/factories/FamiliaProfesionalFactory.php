<?php

namespace Database\Factories;

use App\Models\EcosistemaLaboral;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EcosistemaLaboral>
 */
class FamiliaProfesionalFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'nombre'      => $this->faker->unique()->word(),
            'codigo'      => 'FAMILIA' . $this->faker->unique()->numberBetween(1, 99),
            'descripcion' => $this->faker->sentence(),
        ];
    }
}
