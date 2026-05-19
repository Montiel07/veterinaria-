<?php

namespace App\Http\Controllers;

use App\Models\Paciente;
use Illuminate\Http\Request;

class PacienteController extends Controller
{
    public function index()
    {
        $pacientes = Paciente::latest()->paginate(10);
        return view('modules.pacientes.index', compact('pacientes'));
    }

    public function create()
    {
        return view('modules.pacientes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'especie'          => 'required|string|max:100',
            'raza'             => 'nullable|string|max:100',
            'sexo'             => 'required|in:Macho,Hembra',
            'fecha_nacimiento' => 'nullable|date',
            'propietario'      => 'required|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'observaciones'    => 'nullable|string',
        ]);

        Paciente::create($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente registrado correctamente.');
    }

    public function edit(Paciente $paciente)
    {
        return view('modules.pacientes.edit', compact('paciente'));
    }

    public function update(Request $request, Paciente $paciente)
    {
        $request->validate([
            'nombre'           => 'required|string|max:255',
            'especie'          => 'required|string|max:100',
            'raza'             => 'nullable|string|max:100',
            'sexo'             => 'required|in:Macho,Hembra',
            'fecha_nacimiento' => 'nullable|date',
            'propietario'      => 'required|string|max:255',
            'telefono'         => 'nullable|string|max:20',
            'observaciones'    => 'nullable|string',
        ]);

        $paciente->update($request->all());

        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente actualizado correctamente.');
    }

    public function destroy(Paciente $paciente)
    {
        $paciente->delete();
        return redirect()->route('pacientes.index')
            ->with('success', 'Paciente eliminado correctamente.');
    }
}
