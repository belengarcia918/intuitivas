<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('producto_variantes', function (Blueprint $table) {
            $table->id();

            $table->foreignId('producto_id')->constrained()->cascadeOnDelete();
            $table->foreignId('color_id')->constrained('colores')->cascadeOnDelete();
            $table->foreignId('talle_id')->constrained('talles')->cascadeOnDelete();

            $table->unsignedInteger('stock')->default(0);

            $table->timestamps();

            $table->unique(['producto_id', 'color_id', 'talle_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('producto_variantes');
    }
};
