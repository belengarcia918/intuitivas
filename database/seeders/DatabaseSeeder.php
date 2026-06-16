<?php

namespace Database\Seeders;

use App\Models\Usuario; // Importamos tu modelo real
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash; // Requerido para encriptar la contraseña

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // 1. CREAMOS EL USUARIO ADMINISTRADOR INICIAL
        Usuario::create([
            'name'      => 'Admin',
            'apellido'  => 'Intuitivas',
            'email'     => 'admin@intuitivas.com',
            'password'  => Hash::make('admin123'), // Contraseña encriptada para el Login
            'rol'       => 'admin', // Clave para que RolMiddleware lo deje entrar a /admin
            'telefono'  => '123456789',
            'direccion' => 'Oficina Central'
        ]);

        // 2. CREAMOS UN USUARIO CLIENTE DE PRUEBA (Opcional, para testear el flujo común)
        Usuario::create([
            'name'      => 'Maria Belen',
            'apellido'  => 'Garcia',
            'email'     => 'mariabelengarcia.918@gmail.com',
            'password'  => Hash::make('1234'), // La que usabas en tu simulación original
            'rol'       => 'cliente', // Entra directo a tu catálogo como cliente logueado
            'telefono'  => '3794000000',
            'direccion' => 'Calle Falsa 123'
        ]);
    }
}
