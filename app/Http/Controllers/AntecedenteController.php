<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Alergia;
use App\Models\Lesion;
use App\Models\Patologico;
use App\Models\HistorialAlimentacion;
use Illuminate\Http\Request;

class AntecedenteController extends Controller
{
    // ─────────────────────────────────────────────
    // ALERGIAS
    // ─────────────────────────────────────────────

    public function alergias($mascota_id, $consulta_id)
    {
        $mascota = Mascota::with(['dueno', 'consultas', 'alergias'])->findOrFail($mascota_id);
        $consultaSeleccionada = $mascota->consultas->firstWhere('id', $consulta_id);

        if (!$consultaSeleccionada) {
            abort(404, 'Consulta no encontrada.');
        }

        return view('modules.expedientes.alergias', compact('mascota', 'consultaSeleccionada'));
    }

    public function guardarAlergia(Request $request, $mascota_id, $consulta_id)
    {
        $request->validate([
            'descripcion' => 'required|string|max:255',
            'tipo'        => 'nullable|string|max:100',
            'severidad'   => 'nullable|string|max:50',
            'fecha_deteccion' => 'nullable|date',
            'notas'       => 'nullable|string',
        ]);

        $mascota = Mascota::findOrFail($mascota_id);

        $mascota->alergias()->create([
            'descripcion'     => $request->input('descripcion'),
            'tipo'            => $request->input('tipo'),
            'severidad'       => $request->input('severidad'),
            'fecha_deteccion' => $request->input('fecha_deteccion'),
            'notas'           => $request->input('notas'),
        ]);

        return redirect()->route('expedientes.consultas.alergias', [$mascota_id, $consulta_id])
            ->with('success', 'Alergia registrada exitosamente.');
    }

    public function eliminarAlergia($mascota_id, $consulta_id, $alergia_id)
    {
        $mascota = Mascota::findOrFail($mascota_id);
        $alergia = $mascota->alergias()->findOrFail($alergia_id);
        $alergia->delete();

        return redirect()->route('expedientes.consultas.alergias', [$mascota_id, $consulta_id])
            ->with('success', 'Alergia eliminada.');
    }

    // ─────────────────────────────────────────────
    // LESIONES
    // ─────────────────────────────────────────────

    public function lesiones($mascota_id, $consulta_id)
    {
        $mascota = Mascota::with(['dueno', 'consultas', 'lesiones'])->findOrFail($mascota_id);
        $consultaSeleccionada = $mascota->consultas->firstWhere('id', $consulta_id);

        if (!$consultaSeleccionada) {
            abort(404, 'Consulta no encontrada.');
        }

        return view('modules.expedientes.lesiones', compact('mascota', 'consultaSeleccionada'));
    }

    public function guardarLesion(Request $request, $mascota_id, $consulta_id)
    {
        $request->validate([
            'descripcion'   => 'required|string|max:255',
            'zona_afectada' => 'nullable|string|max:100',
            'tipo'          => 'nullable|string|max:100',
            'fecha_registro'=> 'nullable|date',
            'activa'        => 'boolean',
            'notas'         => 'nullable|string',
        ]);

        $mascota = Mascota::findOrFail($mascota_id);

        $mascota->lesiones()->create([
            'descripcion'    => $request->input('descripcion'),
            'zona_afectada'  => $request->input('zona_afectada'),
            'tipo'           => $request->input('tipo'),
            'fecha_registro' => $request->input('fecha_registro'),
            'activa'         => $request->boolean('activa', true),
            'notas'          => $request->input('notas'),
        ]);

        return redirect()->route('expedientes.consultas.lesiones', [$mascota_id, $consulta_id])
            ->with('success', 'Lesión registrada exitosamente.');
    }

    public function eliminarLesion($mascota_id, $consulta_id, $lesion_id)
    {
        $mascota = Mascota::findOrFail($mascota_id);
        $lesion  = $mascota->lesiones()->findOrFail($lesion_id);
        $lesion->delete();

        return redirect()->route('expedientes.consultas.lesiones', [$mascota_id, $consulta_id])
            ->with('success', 'Lesión eliminada.');
    }

    // ─────────────────────────────────────────────
    // PATOLÓGICOS
    // ─────────────────────────────────────────────

    public function patologicos($mascota_id, $consulta_id)
    {
        $mascota = Mascota::with(['dueno', 'consultas', 'patologicos'])->findOrFail($mascota_id);
        $consultaSeleccionada = $mascota->consultas->firstWhere('id', $consulta_id);

        if (!$consultaSeleccionada) {
            abort(404, 'Consulta no encontrada.');
        }

        return view('modules.expedientes.patologicos', compact('mascota', 'consultaSeleccionada'));
    }

    public function guardarPatologico(Request $request, $mascota_id, $consulta_id)
    {
        $request->validate([
            'nombre_enfermedad' => 'required|string|max:255',
            'tipo'              => 'nullable|string|max:100',
            'fecha_diagnostico' => 'nullable|date',
            'activo'            => 'boolean',
            'tratamiento_previo'=> 'nullable|string',
            'notas'             => 'nullable|string',
        ]);

        $mascota = Mascota::findOrFail($mascota_id);

        $mascota->patologicos()->create([
            'nombre_enfermedad'  => $request->input('nombre_enfermedad'),
            'tipo'               => $request->input('tipo'),
            'fecha_diagnostico'  => $request->input('fecha_diagnostico'),
            'activo'             => $request->boolean('activo', true),
            'tratamiento_previo' => $request->input('tratamiento_previo'),
            'notas'              => $request->input('notas'),
        ]);

        return redirect()->route('expedientes.consultas.patologicos', [$mascota_id, $consulta_id])
            ->with('success', 'Antecedente patológico registrado exitosamente.');
    }

    public function eliminarPatologico($mascota_id, $consulta_id, $patologico_id)
    {
        $mascota    = Mascota::findOrFail($mascota_id);
        $patologico = $mascota->patologicos()->findOrFail($patologico_id);
        $patologico->delete();

        return redirect()->route('expedientes.consultas.patologicos', [$mascota_id, $consulta_id])
            ->with('success', 'Antecedente patológico eliminado.');
    }

    // ─────────────────────────────────────────────
    // HISTORIAL ALIMENTACIÓN
    // ─────────────────────────────────────────────

    public function alimentacion($mascota_id, $consulta_id)
    {
        $mascota = Mascota::with(['dueno', 'consultas', 'historialAlimentacion'])->findOrFail($mascota_id);
        $consultaSeleccionada = $mascota->consultas->firstWhere('id', $consulta_id);

        if (!$consultaSeleccionada) {
            abort(404, 'Consulta no encontrada.');
        }

        return view('modules.expedientes.alimentacion', compact('mascota', 'consultaSeleccionada'));
    }

    public function guardarAlimentacion(Request $request, $mascota_id, $consulta_id)
    {
        $request->validate([
            'tipo_alimento'      => 'required|string|max:150',
            'marca'              => 'nullable|string|max:150',
            'frecuencia'         => 'nullable|string|max:100',
            'cantidad_por_comida'=> 'nullable|string|max:100',
            'observaciones'      => 'nullable|string',
        ]);

        $mascota = Mascota::findOrFail($mascota_id);

        $mascota->historialAlimentacion()->create([
            'tipo_alimento'       => $request->input('tipo_alimento'),
            'marca'               => $request->input('marca'),
            'frecuencia'          => $request->input('frecuencia'),
            'cantidad_por_comida' => $request->input('cantidad_por_comida'),
            'observaciones'       => $request->input('observaciones'),
        ]);

        return redirect()->route('expedientes.consultas.alimentacion', [$mascota_id, $consulta_id])
            ->with('success', 'Registro de alimentación guardado exitosamente.');
    }

    public function eliminarAlimentacion($mascota_id, $consulta_id, $registro_id)
    {
        $mascota  = Mascota::findOrFail($mascota_id);
        $registro = $mascota->historialAlimentacion()->findOrFail($registro_id);
        $registro->delete();

        return redirect()->route('expedientes.consultas.alimentacion', [$mascota_id, $consulta_id])
            ->with('success', 'Registro de alimentación eliminado.');
    }
}
