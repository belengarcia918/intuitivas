<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
    
        $carrito = session()->get('carrito', []);
        $total = 0;

        return view('frontend.carrito.index', compact('carrito', 'total'));
    }

    public function agregar(Request $request)
    {

        $request->validate([
        'id' => 'required',
        'nombre' => 'required',
        'precio' => 'required|numeric',
        'imagen' => 'required',
        'cantidad' => 'required|integer|min:1',
        'color' => 'required',
        'talle' => 'required',
        ]);
        
        $carrito = session()->get('carrito', []);

        $cantidad = max(1, (int) $request->cantidad);

        // clave única por variante
        $key = $request->id . '-' . $request->color . '-' . $request->talle;

        if(isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += $cantidad;
        } else {
            $carrito[$key] = [
                "id" => $request->id,
                "nombre" => $request->nombre,
                "precio" => $request->precio,
                "imagen" => $request->imagen,
                "cantidad" => $request->cantidad,
                "color" => $request->color,
                "talle" => $request->talle,
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto agregado al carrito 🛒');
    }

    public function eliminar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        unset($carrito[$request->key]);

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto eliminado');
    }

    public function actualizar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if(isset($carrito[$request->key])) {
            $carrito[$request->key]['cantidad'] = $request->cantidad;
        }

        session()->put('carrito', $carrito);

        return back();
    }
}
