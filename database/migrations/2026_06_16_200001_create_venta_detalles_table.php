<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('venta_detalles', function (Blueprint $table) {
            $table->id();
            // Clave foránea que vincula a la cabecera
            $table->foreignId('venta_id')->constrained('venta_cabeceras')->onDelete('cascade');
            // Clave foránea que vincula al producto
            $table->foreignId('producto_id')->constrained('productos')->onDelete('cascade');
            
            $table->integer('cantidad');
            $table->decimal('precio_unitario', 10, 2);
            $table->decimal('subtotal', 10, 2);
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('venta_detalles');
    }
};
