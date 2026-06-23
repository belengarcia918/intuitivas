<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\CarritoItem;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use App\Services\CarritoService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

public function confirmar_compra(Request $request)
{
    $carrito = CarritoService::obtener();

    if (!$carrito || $carrito->items->isEmpty()) {
        return back()->with('error-message', 'El carrito está vacío.');
    }

    DB::beginTransaction();

    try {

        $total = $carrito->items->sum(fn($item) =>
            $item->precio * $item->cantidad
        );

        $venta = VentaCabecera::create([
            'usuario_id'  => Auth::id(),
            'total'       => $total,
            'estado'      => 'confirmado',
            'fecha_venta' => Carbon::now(),
            ...$request->only([
                'codigo_postal','calle','numero',
                'barrio','ciudad','provincia','metodo_pago'
            ])
        ]);

        foreach ($carrito->items as $item) {

            VentaDetalle::create([
                'venta_id'        => $venta->id,
                'producto_id'     => $item->producto_id,
                'cantidad'        => $item->cantidad,
                'precio_unitario' => $item->precio,
                'subtotal'        => $item->precio * $item->cantidad
            ]);
        }

        // Carrito se vacia
        CarritoItem::where('carrito_id', $carrito->id)->delete();

        DB::commit();

        return redirect()
            ->route('cliente.dashboard')
            ->with('success', 'Compra realizada con éxito');

    } catch (\Exception $e) {
        DB::rollBack();

        return back()->with('error-message', $e->getMessage());
    }
}
