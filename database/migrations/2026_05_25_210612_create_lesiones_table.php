<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('lesiones', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->string('descripcion');
            $table->string('zona_afectada')->nullable();
            $table->string('tipo')->nullable(); // traumática, quirúrgica, dermatológica, interna
            $table->date('fecha_registro')->nullable();
            $table->boolean('activa')->default(true);
            $table->text('notas')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('lesiones');
    }
};
