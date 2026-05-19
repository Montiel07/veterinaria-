<?php

namespace App\Http\Controllers;

use App\Models\Mascota;
use App\Models\Dueno;
use Illuminate\Http\Request;

class ExpedienteController extends Controller
{
    /**
     * Mostrar la vista del buscador de expedientes.
     */
    public function index()
    {
        return view('modules.expedientes.index');
    }

    /**
     * Búsqueda instantánea usando Laravel Scout (Database driver)
     */
    public function buscarAjax(Request $request)
    {
        $query = $request->input('q');

        if (empty($query)) {
            return response()->json([]);
        }

        // Buscar IDs de dueños que coincidan con el término
        $duenosIds = Dueno::search($query)->keys();

        // Buscar mascotas que coincidan por nombre o ID, o cuyo dueño coincida
        $resultados = Mascota::search($query)
            ->query(function ($q) use ($duenosIds) {
                $q->orWhereIn('dueno_id', $duenosIds)
                  ->with('dueno');
            })
            ->take(5)
            ->get()
            ->map(function ($mascota) {
                return [
                    'id'            => $mascota->id,
                    'nombre'        => $mascota->nombre,
                    'especie'       => $mascota->especie,
                    'raza'          => $mascota->raza ?? 'Sin raza',
                    'dueno'         => $mascota->dueno->nombre_completo ?? 'Sin dueño',
                    'url_consultas' => route('expedientes.show', $mascota->id),
                ];
            });

        return response()->json($resultados);
    }

    /**
     * Mostrar el expediente completo (mascota y sus consultas).
     */
    public function show($id)
    {
        $mascota = Mascota::with(['dueno', 'consultas.veterinario'])->findOrFail($id);

        return view('modules.expedientes.show', compact('mascota'));
    }
}
