<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\FuncionesCargo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<FuncionesCargo>
 */
class FuncionesCargoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'cargo_id' => Cargo::factory(),
            'descripcion_funcion' => fake()->sentence(),
            'estado' => fake()->boolean(),
        ];
    }
}