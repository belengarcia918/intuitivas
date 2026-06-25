<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use App\Models\VentaCabecera;
use App\Http\Requests\PerfilUpdateRequest;

class ClienteController extends Controller
{
    public function dashboard()
    {
        $usuario = Auth::user();

        $cantItems = session('carrito')
            ? collect(session('carrito'))->sum('cantidad')
            : 0;

        $compras = VentaCabecera::where('usuario_id', $usuario->id)
            ->orderBy('created_at', 'desc')
            ->get();

        $ultimasCompras = $compras->take(3);

        $totalCompras = $compras->count();
        $ultimaCompra = $compras->first();


        return view('frontend.perfil.index', compact(
            'usuario',
            'cantItems',
            'totalCompras',
            'ultimaCompra',
            'compras',
            'ultimasCompras'
        ));
    }

    public function editar()
    {
        return view('frontend.perfil.editar', [
            'usuario' => Auth::user()
        ]);
    }

    public function update(PerfilUpdateRequest $request)
    {
        $usuario = auth()->user();

        $usuario->update([
            'name' => $request->name,
            'apellido' => $request->apellido,
            'email' => $request->email,
            'telefono' => $request->telefono,
            'direccion' => $request->direccion,
        ]);

        if ($request->filled('password')) {
            $usuario->password = bcrypt($request->password);
            $usuario->save();
        }

        return redirect()->route('perfil')->with('success', 'Perfil actualizado correctamente');
    }

    public function compras()
    {
        $usuario = Auth::user();

        $compras = VentaCabecera::where('usuario_id', Auth::id())->get();

        return view('frontend.perfil.compras', compact('compras', 'usuario'));
    }

}
