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
        Schema::create('ventas', function (Blueprint $table) {
            $table->id();
            $table->date('fecha_venta');
            $table->decimal('total', 8, 2);
            $table->decimal('impuesto', 8, 2);
            $table->string('observacion', 100)->nullable();

            $table->unsignedBigInteger('usuario_id');
            $table->foreign('usuario_id')->references('id')->on('users');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ventas');
    }
};
