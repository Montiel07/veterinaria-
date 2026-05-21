<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use Illuminate\Http\Request;

class ConsultaController extends Controller
{
    /**
     * Display the consultations history for the selected mascota.
     */
    public function show($id)
    {
        $mascota = Mascota::with(['dueno', 'consultas.veterinario'])->findOrFail($id);

        return view('modules.expedientes.consultas', compact('mascota'));
    }

    /**
     * Display the specific clinical consultation details and antecedents/history of the pet.
     */
    public function detalle($mascota_id, $consulta_id)
    {
        $mascota = Mascota::with(['dueno', 'consultas.veterinario'])->findOrFail($mascota_id);
        $consultaSeleccionada = $mascota->consultas->firstWhere('id', $consulta_id);

        if (!$consultaSeleccionada) {
            abort(404, 'Consulta no encontrada.');
        }

        // Antecedentes are the other consultations of this pet (excluding the current one)
        $antecedentes = $mascota->consultas
            ->where('id', '!=', $consulta_id)
            ->sortByDesc('fecha_consulta');

        return view('modules.expedientes.detalle', compact('mascota', 'consultaSeleccionada', 'antecedentes'));
    }
}
