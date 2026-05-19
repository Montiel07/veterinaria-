<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Paciente extends Model
{
    protected $table = 'pacientes';

    protected $fillable = [
        'nombre',
        'especie',
        'raza',
        'sexo',
        'fecha_nacimiento',
        'propietario',
        'telefono',
        'observaciones',
    ];
}
