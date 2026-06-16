<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CarritoController extends Controller
{
    public function index()
    {
        $carrito = session('carrito', []);
        return view('frontend.carrito.index', compact('carrito'));
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

        $carrito = session('carrito', []);

        $key = $request->id . '-' . $request->color . '-' . $request->talle;

        if (isset($carrito[$key])) {
            $carrito[$key]['cantidad'] += $request->cantidad;
        } else {
            $carrito[$key] = [
                'id' => $request->id,
                'nombre' => $request->nombre,
                'precio' => $request->precio,
                'imagen' => $request->imagen,
                'cantidad' => $request->cantidad,
                'color' => $request->color,
                'talle' => $request->talle,
            ];
        }

        session()->put('carrito', $carrito);

        return back()->with('open_cart', true);
    }

    public function eliminar(Request $request)
    {
        $carrito = session('carrito', []);

        unset($carrito[$request->key]);

        session()->put('carrito', $carrito);

        return back()->with('open_cart', true);
    }

    public function actualizar(Request $request)
    {
        $carrito = session('carrito', []);

        if (isset($carrito[$request->key])) {
            $carrito[$request->key]['cantidad'] = $request->cantidad;
        }

        session()->put('carrito', $carrito);

        return back()->with('open_cart', true);
    }
}
