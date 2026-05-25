<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Laravel\Scout\Searchable;

class Mascota extends Model
{
    use Searchable;

    protected $fillable = [
        'dueno_id',
        'nombre',
        'especie',
        'raza',
        'fecha_nacimiento',
        'tipo_sangre',
        'comportamiento',
        'es_adoptado',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'es_adoptado' => 'boolean',
    ];

    public function dueno()
    {
        return $this->belongsTo(Dueno::class);
    }

    public function consultas()
    {
        return $this->hasMany(Consulta::class);
    }

    public function alergias()
    {
        return $this->hasMany(Alergia::class);
    }

    public function lesiones()
    {
        return $this->hasMany(Lesion::class);
    }

    public function patologicos()
    {
        return $this->hasMany(Patologico::class);
    }

    public function historialAlimentacion()
    {
        return $this->hasMany(HistorialAlimentacion::class);
    }

    public function toSearchableArray(): array
    {
        return [
            'id' => (int) $this->id,
            'nombre' => $this->nombre,
        ];
    }
}
