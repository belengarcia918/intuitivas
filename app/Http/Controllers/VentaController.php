<?php

namespace App\Http\Controllers;

use App\Models\ProductoVariante;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use App\Services\CarritoService;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\CheckoutRequest;

class VentaController extends Controller
{
    /* =========================
    | LISTADO DE VENTAS (ADMIN)
    ========================= */
    public function index()
    {
        $ventas = VentaCabecera::with([
            'usuario',
            'detalles.producto'
        ])
        ->latest('fecha_venta')
        ->get();

        return view('backend.ventas', compact('ventas'));
    }

    public function checkout(CarritoService $service)
    {
        $carrito = $service->obtener();

        $data = $service->obtenerItemsConTotales($carrito);

        return view(
            'frontend.checkout.index',
            $data
        );
    }

    /* =========================
    | CHECKOUT → FINALIZAR COMPRA
    ========================= */
    public function finalizar(CheckoutRequest $request, CarritoService $service)
    {
        $carrito = $service->obtener();

        $carrito->load([
            'items.producto'
        ]);

        $data = $service->obtenerItemsConTotales($carrito);

        if (count($data['items']) === 0) {
            return back()->with('error', 'El carrito está vacío');
        }

        $dataCheckout = $request->validated();

        $venta = DB::transaction(function () use ($carrito, $data, $dataCheckout) {

            // 1. Crear cabecera
            $venta = VentaCabecera::create([
                'usuario_id'    => auth()->id(),
                'estado'        => 'confirmado',
                'fecha_venta'   => now(),
                'total'         => $data['total'],

                'codigo_postal' => $dataCheckout['codigo_postal'],
                'calle'         => $dataCheckout['calle'],
                'numero'        => $dataCheckout['numero'],
                'barrio'        => $dataCheckout['barrio'],
                'ciudad'        => $dataCheckout['ciudad'],
                'provincia'     => $dataCheckout['provincia'],
                'metodo_pago'   => $dataCheckout['metodo_pago'],
            ]);

            // 2. Crear detalles
            foreach ($carrito->items as $item) {

                $variante = ProductoVariante::where('producto_id', $item->producto_id)
                    ->whereHas('color', function ($q) use ($item) {
                        $q->where('nombre', $item->color);
                    })
                    ->whereHas('talle', function ($q) use ($item) {
                        $q->where('nombre', $item->talle);
                    })
                    ->first();

                if (!$variante) {
                    throw new \Exception('Variante inexistente.');
                }

                if ($item->cantidad > $variante->stock) {
                    throw new \Exception(
                        'Stock insuficiente para ' .
                        $item->producto->nombre
                    );
                }

                $subtotal = $item->precio * $item->cantidad;

                VentaDetalle::create([
                    'venta_id'        => $venta->id,
                    'producto_id'     => $item->producto_id,

                    'nombre_producto' => $item->producto->nombre,
                    'color'           => $item->color,
                    'talle'           => $item->talle,

                    'cantidad'        => $item->cantidad,
                    'precio_unitario' => $item->precio,
                    'subtotal'        => $subtotal,
                ]);

                $variante->decrement('stock', $item->cantidad);
            }

            // 3. Vaciar carrito
            $carrito->items()->delete();

            // IMPORTANTE
            return $venta;
        });

        return redirect()
            ->route('checkout.exito', $venta);
    }

    public function exito(VentaCabecera $venta)
    {
        if ($venta->usuario_id !== auth()->id()) {
            abort(403);
        }

        return view(
            'frontend.checkout.exito',
            compact('venta')
        );
    }

}
