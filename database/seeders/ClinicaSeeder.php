<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Veterinario;
use App\Models\Dueno;
use App\Models\Mascota;
use App\Models\Consulta;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class ClinicaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // 1. Obtener o crear un usuario con rol veterinario
        $userVet = User::where('email', 'vet@vet.com')->first();
        if (!$userVet) {
            $userVet = User::create([
                'name'     => 'veterinario',
                'email'    => 'vet@vet.com',
                'password' => Hash::make('vet123'),
                'rol'      => 'veterinario',
            ]);
        }

        // 2. Crear el registro del Veterinario asociado
        $veterinario = Veterinario::updateOrCreate(
            ['usuario_id' => $userVet->id],
            [
                'nombre_completo'    => 'Dr. Alejandro Magno',
                'especialidad'       => 'Cirugía y Ortopedia Veterinaria',
                'cedula_profesional' => 'VET-9876543-A',
                'foto_firma'         => null,
            ]
        );

        // 3. Crear el Dueño de las mascotas
        $dueno = Dueno::create([
            'nombre_completo' => 'María del Carmen Flores',
            'telefono'        => '5551234567',
            'direccion'       => 'Av. Revolución 1420, Colonia San Ángel, CDMX',
        ]);

        // 4. Crear las Mascotas del dueño
        $perro = Mascota::create([
            'dueno_id'         => $dueno->id,
            'nombre'           => 'Toby',
            'especie'          => 'Perro',
            'raza'             => 'Golden Retriever',
            'fecha_nacimiento' => '2021-04-12',
            'tipo_sangre'      => 'DEA 1.1',
            'comportamiento'   => 'Dócil y juguetón',
            'es_adoptado'      => false,
        ]);

        $gato = Mascota::create([
            'dueno_id'         => $dueno->id,
            'nombre'           => 'Luna',
            'especie'          => 'Gato',
            'raza'             => 'Siamés',
            'fecha_nacimiento' => '2023-01-20',
            'tipo_sangre'      => 'Grupo A',
            'comportamiento'   => 'Tímida pero amigable',
            'es_adoptado'      => true,
        ]);

        // 5. Crear 2 Consultas Médicas para Toby
        Consulta::create([
            'mascota_id'     => $perro->id,
            'veterinario_id' => $veterinario->id,
            'fecha_consulta' => '2026-05-10 10:30:00',
            'peso'           => 32.50,
            'talla'          => 60.00,
            'diagnostico'    => 'Chequeo anual de rutina. Ligera otitis eritematosa en oído derecho.',
            'tratamiento'    => 'Limpieza ótica diaria y gotas Otovet (5 gotas cada 12h por 7 días).',
        ]);

        Consulta::create([
            'mascota_id'     => $perro->id,
            'veterinario_id' => $veterinario->id,
            'fecha_consulta' => '2026-05-17 11:15:00',
            'peso'           => 32.65,
            'talla'          => 60.00,
            'diagnostico'    => 'Consulta de seguimiento para otitis. El canal auditivo se observa limpio y sin inflamación.',
            'tratamiento'    => 'Alta médica de la otitis. Se recomienda continuar con limpieza general cada 15 días.',
        ]);
    }
}
