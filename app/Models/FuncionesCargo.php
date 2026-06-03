<?php

namespace App\Models;

use Database\Factories\FuncionesCargoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

#[Fillable(['cargo_id', 'descripcion_funcion', 'estado'])]
class FuncionesCargo extends Model
{
    /** @use HasFactory<FuncionesCargoFactory> */
    use HasFactory;

    protected $table = 'funciones_cargo';

    protected function casts(): array
    {
        return [
            'estado' => 'boolean',
        ];
    }

    public function cargo(): BelongsTo
    {
        return $this->belongsTo(Cargo::class);
    }
}