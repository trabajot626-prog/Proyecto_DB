<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreFuncionesCargoRequest;
use App\Http\Requests\Api\UpdateFuncionesCargoRequest;
use App\Models\FuncionesCargo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FuncionesCargoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = FuncionesCargo::query()->with('cargo');

        $this->applySearchFilter($query, $request, ['descripcion_funcion']);
        $this->applyIdsFilter($query, $request);

        if ($request->filled('cargo_id')) {
            $query->where('cargo_id', $request->integer('cargo_id'));
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->boolean('estado'));
        }

        return response()->json($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreFuncionesCargoRequest $request): JsonResponse
    {
        $funcion = FuncionesCargo::create($request->validated());

        return response()->json($funcion->load('cargo'), 201);
    }

    public function show(FuncionesCargo $funcionesCargo): JsonResponse
    {
        return response()->json($funcionesCargo->load('cargo'));
    }

    public function update(UpdateFuncionesCargoRequest $request, FuncionesCargo $funcionesCargo): JsonResponse
    {
        $funcionesCargo->update($request->validated());

        return response()->json($funcionesCargo->fresh()->load('cargo'));
    }

    public function destroy(FuncionesCargo $funcionesCargo): JsonResponse
    {
        $funcionesCargo->delete();

        return response()->json(null, 204);
    }
}