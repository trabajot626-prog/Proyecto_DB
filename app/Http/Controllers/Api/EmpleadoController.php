<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreEmpleadoRequest;
use App\Http\Requests\Api\UpdateEmpleadoRequest;
use App\Models\Empleado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class EmpleadoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        $query = Empleado::query()->with('cargo');

        $this->applySearchFilter($query, $request, ['nombre']);
        $this->applyIdsFilter($query, $request);

        if ($request->filled('cargo_id')) {
            $query->where('cargo_id', $request->integer('cargo_id'));
        }

        if ($request->filled('estado')) {
            $query->where('estado', $request->boolean('estado'));
        }

        $from = $request->query('fecha_ingreso_from');
        $to = $request->query('fecha_ingreso_to');

        if ($from !== null && $to !== null) {
            $query->whereBetween('fecha_ingreso', [$from, $to]);
        }

        return response()->json($query->paginate($request->integer('per_page', 15)));
    }

    public function store(StoreEmpleadoRequest $request): JsonResponse
    {
        $empleado = Empleado::create($request->validated());

        return response()->json($empleado->load('cargo'), 201);
    }

    public function show(Empleado $empleado): JsonResponse
    {
        return response()->json($empleado->load('cargo'));
    }

    public function update(UpdateEmpleadoRequest $request, Empleado $empleado): JsonResponse
    {
        $empleado->update($request->validated());

        return response()->json($empleado->fresh()->load('cargo'));
    }

    public function destroy(Empleado $empleado): JsonResponse
    {
        $empleado->delete();

        return response()->json(null, 204);
    }
}