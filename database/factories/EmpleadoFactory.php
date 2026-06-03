<?php

namespace Database\Factories;

use App\Models\Cargo;
use App\Models\Empleado;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Empleado>
 */
class EmpleadoFactory extends Factory
{
    public function definition(): array
    {
        return [
            'nombre' => fake()->name(),
            'fecha_nacimiento' => fake()->date(),
            'fecha_ingreso' => fake()->date(),
            'estado' => fake()->boolean(),
            'cargo_id' => Cargo::factory(),
        ];
    }
}