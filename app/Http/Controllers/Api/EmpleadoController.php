<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Empleado;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

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

    public function store(Request $request): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'fecha_ingreso' => ['required', 'date'],
            'estado' => ['required', 'boolean'],
            'cargo_id' => ['required', 'integer', 'exists:cargos,id', Rule::unique('empleados', 'cargo_id')],
        ]);

        $empleado = Empleado::create($data);

        return response()->json($empleado->load('cargo'), 201);
    }

    public function show(Empleado $empleado): JsonResponse
    {
        return response()->json($empleado->load('cargo'));
    }

    public function update(Request $request, Empleado $empleado): JsonResponse
    {
        $data = $request->validate([
            'nombre' => ['sometimes', 'required', 'string', 'max:255'],
            'fecha_nacimiento' => ['sometimes', 'required', 'date'],
            'fecha_ingreso' => ['sometimes', 'required', 'date'],
            'estado' => ['sometimes', 'required', 'boolean'],
            'cargo_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:cargos,id',
                Rule::unique('empleados', 'cargo_id')->ignore($empleado->id),
            ],
        ]);

        $empleado->update($data);

        return response()->json($empleado->fresh()->load('cargo'));
    }

    public function destroy(Empleado $empleado): JsonResponse
    {
        $empleado->delete();

        return response()->json(null, 204);
    }
}