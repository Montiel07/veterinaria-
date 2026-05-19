<?php

namespace App\Http\Controllers;

use App\Models\Direccion;
use Illuminate\Http\Request;

class DireccionController extends Controller
{
    public function index()
    {
        $direcciones = Direccion::latest()->paginate(10);
        return view('modules.direcciones.index', compact('direcciones'));
    }

    public function create()
    {
        return view('modules.direcciones.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'calle'         => 'required|string|max:255',
            'colonia'       => 'required|string|max:255',
            'ciudad'        => 'required|string|max:255',
            'estado'        => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'referencias'   => 'nullable|string',
        ]);

        Direccion::create($request->all());

        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección registrada correctamente.');
    }

    public function edit(Direccion $direccione)
    {
        return view('modules.direcciones.edit', ['direccion' => $direccione]);
    }

    public function update(Request $request, Direccion $direccione)
    {
        $request->validate([
            'calle'         => 'required|string|max:255',
            'colonia'       => 'required|string|max:255',
            'ciudad'        => 'required|string|max:255',
            'estado'        => 'required|string|max:255',
            'codigo_postal' => 'required|string|max:10',
            'referencias'   => 'nullable|string',
        ]);

        $direccione->update($request->all());

        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección actualizada correctamente.');
    }

    public function destroy(Direccion $direccione)
    {
        $direccione->delete();
        return redirect()->route('direcciones.index')
            ->with('success', 'Dirección eliminada correctamente.');
    }
}
