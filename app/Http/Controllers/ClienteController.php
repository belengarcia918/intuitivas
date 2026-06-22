<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class ClienteController extends Controller
{
    public function dashboard()
    {
        $usuario = Auth::user();

        $cantItems = session('carrito')
            ? collect(session('carrito'))->sum('cantidad')
            : 0;

        return view('backend.usuarios.cliente', compact('usuario', 'cantItems'));
    }
}
