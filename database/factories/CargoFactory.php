<?php

namespace Database\Factories;

use App\Models\Cargo;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Cargo>
 */
class CargoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre_cargo' => fake()->jobTitle(),
            'descripcion' => fake()->sentence(),
        ];
    }
}