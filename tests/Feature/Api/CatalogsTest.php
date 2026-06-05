<?php

use App\Models\Cargo;
use App\Models\Empleado;
use App\Models\FuncionesCargo;
use App\Models\User;

beforeEach(function (): void {
    $this->user = User::factory()->create();
    $this->actingAs($this->user, 'sanctum');
});

test('el CRUD de cargos funciona y soporta filtros de búsqueda', function (): void {
    Cargo::factory()->create([
        'nombre_cargo' => 'Jefe de sistema',
        'descripcion' => 'Coordina el area de tecnologia.',
    ]);

    $create = $this->postJson('/api/cargos', [
        'nombre_cargo' => 'Analista',
        'descripcion' => 'Analiza procesos y datos.',
    ]);

    $create->assertCreated();

    $cargoId = $create->json('id');

    $this->getJson('/api/cargos?search=Anal')
        ->assertOk()
        ->assertJsonFragment(['id' => $cargoId]);

    $this->patchJson('/api/cargos/'.$cargoId, [
        'descripcion' => 'Analiza procesos, datos y reportes.',
    ])->assertOk();

    $this->deleteJson('/api/cargos/'.$cargoId)->assertNoContent();
});

test('el CRUD de empleados funciona con relaciones y filtros de fecha', function (): void {
    $cargo = Cargo::factory()->create();

    $create = $this->postJson('/api/empleados', [
        'nombre' => 'Maria Perez',
        'fecha_nacimiento' => '1998-04-20',
        'fecha_ingreso' => '2026-01-15',
        'estado' => true,
        'cargo_id' => $cargo->id,
    ]);

    $create->assertCreated();

    $empleadoId = $create->json('id');

    $this->getJson('/api/empleados?search=Maria&fecha_ingreso_from=2026-01-01&fecha_ingreso_to=2026-12-31')
        ->assertOk()
        ->assertJsonFragment(['id' => $empleadoId]);

    $this->patchJson('/api/empleados/'.$empleadoId, [
        'estado' => false,
    ])->assertOk();

    $this->deleteJson('/api/empleados/'.$empleadoId)->assertNoContent();
});

test('el CRUD de funciones de cargo funciona y soporta filtro por cargo', function (): void {
    $cargo = Cargo::factory()->create();

    $create = $this->postJson('/api/funciones-cargo', [
        'cargo_id' => $cargo->id,
        'descripcion_funcion' => 'Supervisar el cumplimiento de procesos.',
        'estado' => true,
    ]);

    $create->assertCreated();

    $funcionId = $create->json('id');

    $this->getJson('/api/funciones-cargo?cargo_id='.$cargo->id)
        ->assertOk()
        ->assertJsonFragment(['id' => $funcionId]);

    $this->patchJson('/api/funciones-cargo/'.$funcionId, [
        'estado' => false,
    ])->assertOk();

    $this->deleteJson('/api/funciones-cargo/'.$funcionId)->assertNoContent();
});