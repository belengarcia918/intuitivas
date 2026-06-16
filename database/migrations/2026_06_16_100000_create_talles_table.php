<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('talles', function (Blueprint $table) {
            $table->engine = 'InnoDB';

            $table->id();
            $table->string('nombre'); // S, M, L, XL

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('talles');
    }
};
