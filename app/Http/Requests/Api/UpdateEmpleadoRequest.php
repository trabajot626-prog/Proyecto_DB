<?php

namespace App\Http\Requests\Api;

use App\Models\Empleado;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateEmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        /** @var Empleado|null $empleado */
        $empleado = $this->route('empleado');

        return [
            'nombre' => ['sometimes', 'required', 'string', 'max:255'],
            'fecha_nacimiento' => ['sometimes', 'required', 'date'],
            'fecha_ingreso' => ['sometimes', 'required', 'date'],
            'estado' => ['sometimes', 'required', 'boolean'],
            'cargo_id' => [
                'sometimes',
                'required',
                'integer',
                'exists:cargos,id',
                Rule::unique('empleados', 'cargo_id')->ignore($empleado?->id),
            ],
        ];
    }
}