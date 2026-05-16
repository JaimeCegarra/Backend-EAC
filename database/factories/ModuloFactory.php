<?php

namespace Database\Factories;

use App\Models\EcosistemaLaboral;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<EcosistemaLaboral>
 */
class ModuloFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'ciclo_formativo_id' => \App\Models\CicloFormativo::factory(),
            'nombre'             => $this->faker->unique()->word(),
            'codigo'             => 'MOD' . $this->faker->unique()->numberBetween(1, 99),
            'horas_totales'      => $this->faker->numberBetween(10, 100),
            'descripcion'        => $this->faker->sentence(),
        ];
    }
}
