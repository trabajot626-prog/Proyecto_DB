<?php

namespace App\Http\Requests\Api;

use Illuminate\Foundation\Http\FormRequest;

class UpdateFuncionesCargoRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'cargo_id' => ['sometimes', 'required', 'integer', 'exists:cargos,id'],
            'descripcion_funcion' => ['sometimes', 'required', 'string'],
            'estado' => ['sometimes', 'required', 'boolean'],
        ];
    }
}