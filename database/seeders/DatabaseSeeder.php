<?php

namespace Database\Seeders;

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\FuncionesCargo;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $cargo = Cargo::factory()->create([
            'nombre_cargo' => 'Administrador',
            'descripcion' => 'Gestiona el sistema y las operaciones principales.',
        ]);

        Empleado::factory()->create([
            'nombre' => 'Test User',
            'fecha_nacimiento' => now()->subYears(25)->toDateString(),
            'fecha_ingreso' => now()->toDateString(),
            'estado' => true,
            'cargo_id' => $cargo->id,
        ]);

        FuncionesCargo::factory()->count(3)->create([
            'cargo_id' => $cargo->id,
            'estado' => true,
        ]);

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
