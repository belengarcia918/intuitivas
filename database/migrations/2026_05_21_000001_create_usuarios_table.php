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
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id(); // ID autoincremental (Llave primaria)
            
            // Datos obligatorios del registro
            $table->string('name');      // Mapeado con el input name="name"
            $table->string('apellido');  // Mapeado con el input name="apellido"
            $table->string('email')->unique(); // El correo debe ser único en la BD
            $table->string('password');  // Contraseña (guardará el Hash encriptado)
            
            // Datos opcionales (Llevan ->nullable() para que HeidiSQL permita vacíos)
            $table->string('telefono')->nullable();   // Teléfono del cliente
            $table->string('direccion')->nullable();  // Dirección de envío
            
            // Sistema de Roles para el Middleware
            // Por defecto, cualquiera que se registre desde la web será 'cliente'
            $table->string('rol')->default('cliente'); 
            
            $table->rememberToken(); // Requerido por Laravel si usan el checkbox "Recordarme"
            $table->softDeletes();
            $table->timestamps();    // Crea automáticamente las columnas created_at y updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};
