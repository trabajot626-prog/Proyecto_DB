<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class StoreFuncionesCargoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cargo_id' => ['required', 'integer', 'exists:cargos,id'],
            'descripcion_funcion' => ['required', 'string'],
            'estado' => ['required', 'boolean'],
        ];
    }
}