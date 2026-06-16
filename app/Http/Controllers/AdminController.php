<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Usuario;

class AdminController extends Controller
{
    /**
     * Muestra la vista principal del Dashboard de Administración
     */
    public function dashboard() 
    {
        // Contadores rápidos usando tu modelo Usuario y filtrando por la columna 'rol'
        $totalProductos = Producto::count();
        $totalClientes  = Usuario::where('rol', 'cliente')->count(); // <-- Cambiado a Usuario

        // Retorna el archivo blade que el PDF ubica en: resources/views/backend/admin/dashboard.blade.php
        return view('backend.admin.dashboard', compact('totalProductos', 'totalClientes'));
    }
}
