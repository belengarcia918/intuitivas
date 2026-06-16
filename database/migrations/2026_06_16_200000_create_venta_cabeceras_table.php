<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venta_cabeceras', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios')->onDelete('cascade');
            $table->string('estado')->default('confirmado');
            $table->decimal('total', 10, 2);
            $table->timestamp('fecha_venta');
            
            // Datos de envio
            $table->string('codigo_postal');
            $table->string('calle');
            $table->integer('numero');
            $table->string('barrio');
            $table->string('ciudad');
            $table->string('provincia');
            $table->string('metodo_pago');
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venta_cabeceras');
    }
};
