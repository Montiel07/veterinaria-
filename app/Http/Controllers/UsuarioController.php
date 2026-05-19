<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\StoreUsuarioRequest;
use App\Http\Requests\UpdateUsuarioRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = User::latest()->paginate(5);
        return view('modules.usuarios.index', compact('usuarios'));
    }

    public function create()
    {
        return view('modules.usuarios.create');
    }

    public function store(StoreUsuarioRequest $request)
    {
        $usuario = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'rol'      => $request->rol,
        ]);

        if ($request->rol === 'veterinario') {
            $fotoPath = null;
            if ($request->hasFile('foto_firma')) {
                $fotoPath = $request->file('foto_firma')->store('veterinarios', 'public');
            }

            $usuario->veterinario()->create([
                'nombre_completo' => $request->nombre_completo,
                'especialidad' => $request->especialidad,
                'cedula_profesional' => $request->cedula_profesional,
                'foto_firma' => $fotoPath,
            ]);
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado correctamente.');
    }

    public function show(User $usuario)
    {
        $hasDependencies = $usuario->hasDependencies();
        return view('modules.usuarios.show', compact('usuario', 'hasDependencies'));
    }

    public function edit(User $usuario)
    {
        return view('modules.usuarios.edit', compact('usuario'));
    }

    public function update(UpdateUsuarioRequest $request, User $usuario)
    {
        $usuario->name  = $request->name;
        $usuario->email = $request->email;
        $usuario->rol   = $request->rol;
        if ($request->filled('password')) {
            $usuario->password = Hash::make($request->password);
        }
        $usuario->save();

        if ($request->rol === 'veterinario') {
            $fotoPath = $usuario->veterinario->foto_firma ?? null;
            if ($request->hasFile('foto_firma')) {
                if ($fotoPath) {
                    Storage::disk('public')->delete($fotoPath);
                }
                $fotoPath = $request->file('foto_firma')->store('veterinarios', 'public');
            }

            $usuario->veterinario()->updateOrCreate(
                ['usuario_id' => $usuario->id],
                [
                    'nombre_completo' => $request->nombre_completo,
                    'especialidad' => $request->especialidad,
                    'cedula_profesional' => $request->cedula_profesional,
                    'foto_firma' => $fotoPath,
                ]
            );
        } else {
            if ($usuario->veterinario) {
                if ($usuario->veterinario->foto_firma) {
                    Storage::disk('public')->delete($usuario->veterinario->foto_firma);
                }
                $usuario->veterinario()->delete();
            }
        }

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado correctamente.');
    }

    public function destroy(User $usuario)
    {
        if ($usuario->hasDependencies()) {
            return redirect()->route('usuarios.index')
                ->with('error', 'No se puede eliminar el usuario porque tiene registros asociados en el sistema.');
        }

        try {
            if ($usuario->veterinario && $usuario->veterinario->foto_firma) {
                Storage::disk('public')->delete($usuario->veterinario->foto_firma);
            }
            $usuario->delete();
            return redirect()->route('usuarios.index')
                ->with('success', 'Usuario eliminado correctamente.');
        } catch (\Illuminate\Database\QueryException $e) {
            if ($e->getCode() == "23000") {
                return redirect()->route('usuarios.index')
                    ->with('error', 'No se puede eliminar el usuario porque tiene registros asociados por llave foránea.');
            }
            throw $e;
        }
    }
}
