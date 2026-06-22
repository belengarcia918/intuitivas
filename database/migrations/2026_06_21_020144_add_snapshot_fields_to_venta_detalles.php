<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('venta_detalles', function (Blueprint $table) {

            $table->string('nombre_producto')
                ->after('producto_id');

            $table->string('color')
                ->nullable()
                ->after('nombre_producto');

            $table->string('talle')
                ->nullable()
                ->after('color');

        });
    }

    public function down(): void
    {
        Schema::table('venta_detalles', function (Blueprint $table) {

            $table->dropColumn([
                'nombre_producto',
                'color',
                'talle'
            ]);

        });
    }
};
