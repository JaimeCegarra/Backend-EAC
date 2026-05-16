<?php

namespace Database\Factories;

use App\Models\EcosistemaLaboral;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EcosistemaLaboral>
 */
class CicloFormativoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'familia_profesional_id' => \App\Models\FamiliaProfesional::factory(),
            'nombre'                 => $this->faker->unique()->word(),
            'codigo'                 => 'CICLO' . $this->faker->unique()->numberBetween(1, 99),
            'grado'                  => $this->faker->randomElement(['GB','GM','GS','CE']),
            'descripcion'            => $this->faker->sentence(),
        ];
    }
}
