<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HistorialAlimentacion extends Model
{
    protected $table = 'historiales_alimentacion';

    protected $fillable = [
        'mascota_id',
        'tipo_alimento',
        'marca',
        'frecuencia',
        'cantidad_por_comida',
        'observaciones',
    ];

    public function mascota()
    {
        return $this->belongsTo(Mascota::class);
    }
}
