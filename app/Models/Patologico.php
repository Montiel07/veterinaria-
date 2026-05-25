<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Patologico extends Model
{
    protected $fillable = [
        'mascota_id',
        'nombre_enfermedad',
        'tipo',
        'fecha_diagnostico',
        'activo',
        'tratamiento_previo',
        'notas',
    ];

    protected $casts = [
        'fecha_diagnostico' => 'date',
        'activo' => 'boolean',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
