<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreCargoRequest;
use App\Http\Requests\Api\UpdateCargoRequest;
use App\Models\Cargo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CargoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Cargo::query()->with(['empleado', 'funcionesCargo']);

        $this->applySearchFilter($query, $request, ['nombre_cargo', 'descripcion']);
        $this->applyIdsFilter($query, $request);

        return response()->json($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreCargoRequest $request): JsonResponse
    {
        $cargo = Cargo::create($request->validated());

        return response()->json($cargo->load(['empleado', 'funcionesCargo']), 201);
    }

    public function show(Cargo $cargo): JsonResponse
    {
        return response()->json($cargo->load(['empleado', 'funcionesCargo']));
    }

    public function update(UpdateCargoRequest $request, Cargo $cargo): JsonResponse
    {
        $cargo->update($request->validated());

        return response()->json($cargo->fresh()->load(['empleado', 'funcionesCargo']));
    }

    public function destroy(Cargo $cargo): JsonResponse
    {
        $cargo->delete();

        return response()->json(null, 204);
    }
}