<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    protected $table = 'direcciones';

    protected $fillable = [
        'calle',
        'colonia',
        'ciudad',
        'estado',
        'codigo_postal',
        'referencias',
    ];
}
