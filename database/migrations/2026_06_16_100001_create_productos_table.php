<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('productos', function (Blueprint $table) {
            $table->id();

            $table->string('nombre_producto', 100);
            $table->text('descripcion_producto')->nullable();

            $table->decimal('precio_producto', 10, 2);
            $table->integer('stock_producto')->default(0);
            $table->string('color', 50)->nullable();
            $table->string('talle', 10)->nullable();

            // Relación con categorías
            $table->foreignId('categoria_id')
                ->constrained('categorias')
                ->onDelete('cascade');

            // Estado del producto
            $table->boolean('activo')->default(true);

            $table->timestamps();

            // Soft deletes (para "eliminar sin borrar")
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('productos');
    }
};
