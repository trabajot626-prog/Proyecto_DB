<?php

namespace App\Models;

use Database\Factories\CargoFactory;
use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

#[Fillable(['nombre_cargo', 'descripcion'])]
class Cargo extends Model
{
    /** @use HasFactory<CargoFactory> */
    use HasFactory;

    public function empleado(): HasOne
    {
        return $this->hasOne(Empleado::class);
    }

    public function funcionesCargo(): HasMany
    {
        return $this->hasMany(FuncionesCargo::class, 'cargo_id');
    }
}