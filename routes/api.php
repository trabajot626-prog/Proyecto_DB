<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CargoController;
use App\Http\Controllers\Api\EmpleadoController;
use App\Http\Controllers\Api\FuncionesCargoController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function (): void {
    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::apiResource('cargos', CargoController::class);
    Route::apiResource('empleados', EmpleadoController::class);
    Route::apiResource('funciones-cargo', FuncionesCargoController::class)
        ->parameters(['funciones-cargo' => 'funcionesCargo']);
});
