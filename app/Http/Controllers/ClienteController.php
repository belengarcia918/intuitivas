<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ClienteController extends Controller
{
    /**
     * Muestra el panel inicial o de bienvenida para el cliente común
     */
    public function dashboard()
    {
        // Retorna el archivo blade que el PDF ubica en: resources/views/backend/usuarios/cliente.blade.php
        return view('backend.usuarios.cliente');
    }
}
