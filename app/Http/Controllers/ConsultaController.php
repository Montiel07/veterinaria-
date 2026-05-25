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

    /**
     * Show the view to create or edit the treatment of a specific consultation.
     */
    public function tratamiento($mascota_id, $consulta_id)
    {
        $mascota = Mascota::with(['dueno', 'consultas'])->findOrFail($mascota_id);
        $consultaSeleccionada = $mascota->consultas->firstWhere('id', $consulta_id);

        if (!$consultaSeleccionada) {
            abort(404, 'Consulta no encontrada.');
        }

        return view('modules.expedientes.tratamiento', compact('mascota', 'consultaSeleccionada'));
    }

    /**
     * Save/update the diagnosis of a specific consultation.
     */
    public function guardarDiagnostico(Request $request, $mascota_id, $consulta_id)
    {
        $request->validate([
            'diagnostico' => 'nullable|string',
        ]);

        $mascota = Mascota::findOrFail($mascota_id);
        $consulta = $mascota->consultas()->findOrFail($consulta_id);

        // Check if there is already a saved diagnosis
        $esNuevo = is_null($consulta->diagnostico) || trim($consulta->diagnostico) === '';

        $consulta->update([
            'diagnostico' => $request->input('diagnostico'),
        ]);

        $mensaje = $esNuevo ? 'Se guardó la nueva información.' : 'Se actualizó con éxito.';

        return redirect()->route('expedientes.consultas.detalle', [$mascota_id, $consulta_id])
            ->with('success', $mensaje);
    }

    /**
     * Save/update the treatment of a specific consultation.
     */
    public function guardarTratamiento(Request $request, $mascota_id, $consulta_id)
    {
        $request->validate([
            'tratamiento' => 'nullable|string',
        ]);

        $mascota = Mascota::findOrFail($mascota_id);
        $consulta = $mascota->consultas()->findOrFail($consulta_id);

        $esNuevo = is_null($consulta->tratamiento) || trim($consulta->tratamiento) === '';

        $consulta->update([
            'tratamiento' => $request->input('tratamiento'),
        ]);

        $mensaje = $esNuevo ? 'Tratamiento guardado exitosamente.' : 'Tratamiento actualizado con éxito.';

        return redirect()->route('expedientes.consultas.tratamiento', [$mascota_id, $consulta_id])
            ->with('success', $mensaje);
    }
}
