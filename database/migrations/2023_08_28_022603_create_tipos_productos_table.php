<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('tipos_productos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 45)->unique();
            $table->string('descripcion', 100)->nullable();
            $table->enum('estado', ['activo', 'inactivo'])->default('activo');
           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tipos_productos');
    }
};
