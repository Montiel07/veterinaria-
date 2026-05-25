<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('patologicos', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->string('nombre_enfermedad');
            $table->string('tipo')->nullable(); // infecciosa, hereditaria, crónica, parasitaria, degenerativa
            $table->date('fecha_diagnostico')->nullable();
            $table->boolean('activo')->default(true); // si sigue activo el padecimiento
            $table->text('tratamiento_previo')->nullable();
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('patologicos');
    }
};
