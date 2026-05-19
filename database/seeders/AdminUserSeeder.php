<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Crear usuario administrador
        User::create([
            'name'     => 'admin',
            'email'    => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'rol'      => 'administrador',
        ]);

        // Crear usuario veterinario
        User::create([
            'name'     => 'veterinario',
            'email'    => 'vet@vet.com',
            'password' => Hash::make('vet123'),
            'rol'      => 'veterinario',
        ]);
    }
}
