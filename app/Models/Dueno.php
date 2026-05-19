<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class Dueno extends Model
{
    use Searchable;

    protected $fillable = [
        'nombre_completo',
        'telefono',
        'direccion',
    ];

    public function mascotas()
    {
        return $this->hasMany(Mascota::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'nombre_completo' => $this->nombre_completo,
        ];
    }
}
