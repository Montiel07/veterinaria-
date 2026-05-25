<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Alergia extends Model
{
    protected $fillable = [
        'mascota_id',
        'descripcion',
        'tipo',
        'severidad',
        'fecha_deteccion',
        'notas',
    ];

    protected $casts = [
        'fecha_deteccion' => 'date',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
