<?php

namespace App\Http\Controllers;

use App\Models\VentaCabecera;
use Illuminate\Http\Request;

class VentaController extends Controller 
{
    public function index() 
    {
        // 'detalles.producto' es la relación encadenada (Venta -> Detalle -> Producto)
        $ventas = VentaCabecera::with(['usuario', 'detalles.producto'])
            ->orderBy('fecha_venta', 'desc')
            ->get();

        return view('backend.ventas', compact('ventas'));
    }
}
