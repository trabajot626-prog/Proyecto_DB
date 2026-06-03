<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
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

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'cargo_id' => ['required', 'integer', 'exists:cargos,id'],
            'descripcion_funcion' => ['required', 'string'],
            'estado' => ['required', 'boolean'],
        ]);

        $funcion = FuncionesCargo::create($data);

        return response()->json($funcion->load('cargo'), 201);
    }

    public function show(FuncionesCargo $funcionesCargo): JsonResponse
    {
        return response()->json($funcionesCargo->load('cargo'));
    }

    public function update(Request $request, FuncionesCargo $funcionesCargo): JsonResponse
    {
        $data = $request->validate([
            'cargo_id' => ['sometimes', 'required', 'integer', 'exists:cargos,id'],
            'descripcion_funcion' => ['sometimes', 'required', 'string'],
            'estado' => ['sometimes', 'required', 'boolean'],
        ]);

        $funcionesCargo->update($data);

        return response()->json($funcionesCargo->fresh()->load('cargo'));
    }

    public function destroy(FuncionesCargo $funcionesCargo): JsonResponse
    {
        $funcionesCargo->delete();

        return response()->json(null, 204);
    }
}