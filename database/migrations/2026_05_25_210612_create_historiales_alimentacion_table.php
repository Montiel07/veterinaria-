<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('historiales_alimentacion', function (Blueprint $table) {
            $table->id();
            $table->foreignId('mascota_id')->constrained('mascotas')->onDelete('cascade');
            $table->string('tipo_alimento'); // croquetas, húmedo, casero, mixto, suplemento
            $table->string('marca')->nullable();
            $table->string('frecuencia')->nullable(); // 2 veces al día, libre acceso, etc.
            $table->string('cantidad_por_comida')->nullable(); // 200g, 1 taza, etc.
            $table->text('observaciones')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('historiales_alimentacion');
    }
};
