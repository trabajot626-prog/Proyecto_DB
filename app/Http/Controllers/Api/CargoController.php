<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre_cargo' => ['required', 'string', 'max:255'],
            'descripcion' => ['nullable', 'string'],
        ]);

        $cargo = Cargo::create($data);

        return response()->json($cargo->load(['empleado', 'funcionesCargo']), 201);
    }

    public function show(Cargo $cargo): JsonResponse
    {
        return response()->json($cargo->load(['empleado', 'funcionesCargo']));
    }

    public function update(Request $request, Cargo $cargo): JsonResponse
    {
        $data = $request->validate([
            'nombre_cargo' => ['sometimes', 'required', 'string', 'max:255'],
            'descripcion' => ['sometimes', 'nullable', 'string'],
        ]);

        $cargo->update($data);

        return response()->json($cargo->fresh()->load(['empleado', 'funcionesCargo']));
    }

    public function destroy(Cargo $cargo): JsonResponse
    {
        $cargo->delete();

        return response()->json(null, 204);
    }
}