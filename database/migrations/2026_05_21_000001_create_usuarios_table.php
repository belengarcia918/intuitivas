<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();

            // DATOS PERSONALES
            $table->string('name', 100);
            $table->string('apellido', 100);
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();

            // SEGURIDAD
            $table->string('password');

            // OPCIONALES
            $table->string('telefono', 30)->nullable();
            $table->string('direccion', 255)->nullable();

            // ROLES CONTROLADOS
            $table->enum('rol', ['admin', 'cliente'])->default('cliente');

            // LARAVEL
            $table->rememberToken();
            $table->softDeletes();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
