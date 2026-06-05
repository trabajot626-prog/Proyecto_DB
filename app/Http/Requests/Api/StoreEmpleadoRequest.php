<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreEmpleadoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'nombre' => ['required', 'string', 'max:255'],
            'fecha_nacimiento' => ['required', 'date'],
            'fecha_ingreso' => ['required', 'date'],
            'estado' => ['required', 'boolean'],
            'cargo_id' => ['required', 'integer', 'exists:cargos,id', Rule::unique('empleados', 'cargo_id')],
        ];
    }
}