<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lesion extends Model
{
    protected $table = 'lesiones';

    protected $fillable = [
        'mascota_id',
        'descripcion',
        'zona_afectada',
        'tipo',
        'fecha_registro',
        'activa',
        'notas',
    ];

    protected $casts = [
        'fecha_registro' => 'date',
        'activa' => 'boolean',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
