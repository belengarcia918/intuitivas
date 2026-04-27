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
        $carrito = session()->get('carrito', []);

        $id = $request->id;

        // Si ya existe el producto, suma cantidad
        if(isset($carrito[$id])) {
            $carrito[$id]['cantidad']++;
        } else {
            // Si no existe, lo agrega
            $carrito[$id] = [
                "nombre" => $request->nombre,
                "precio" => $request->precio,
                "imagen" => $request->imagen,
                "cantidad" => 1
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto agregado al carrito 🛒');
    }

    public function eliminar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        unset($carrito[$request->id]);

        session()->put('carrito', $carrito);

        return back()->with('success', 'Producto eliminado');
    }

    public function actualizar(Request $request)
    {
        $carrito = session()->get('carrito', []);

        if(isset($carrito[$request->id])) {
            $carrito[$request->id]['cantidad'] = $request->cantidad;
        }

        session()->put('carrito', $carrito);

        return back();
    }
}
