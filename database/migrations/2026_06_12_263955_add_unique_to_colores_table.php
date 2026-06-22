<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('colores', function (Blueprint $table) {
            $table->unique(['nombre', 'hex']);
        });
    }

    public function down(): void
    {
        Schema::table('colores', function (Blueprint $table) {
            $table->dropUnique(['nombre', 'hex']);
        });
    }
};