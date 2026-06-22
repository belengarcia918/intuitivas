<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Carrito;
use App\Models\CarritoItem;
use App\Models\Producto;
use App\Models\ProductoVariante;
use App\Services\CarritoService;

class CarritoController extends Controller
{
    private function carrito()
    {
        return CarritoService::obtener();
    }

    public function index(CarritoService $service)
    {
        $carrito = $service->obtener();
        $data = $service->obtenerItemsConTotales($carrito);

        return view('frontend.carrito.index', $data);
    }

    public function agregar(Request $request)
    {
        $request->validate([
            'producto_id' => 'required|exists:productos,id',
            'cantidad'    => 'required|integer|min:1',
            'color'       => 'required',
            'talle'       => 'required',
        ]);

        $carrito = $this->carrito();

        $producto = Producto::findOrFail(
            $request->producto_id
        );

        $variante = ProductoVariante::where(
            'producto_id',
            $producto->id
        )
        ->whereHas('color', function ($q) use ($request) {
            $q->where('nombre', $request->color);
        })
        ->whereHas('talle', function ($q) use ($request) {
            $q->where('nombre', $request->talle);
        })
        ->first();

        if (!$variante) {
            return back()->with(
                'error',
                'La variante seleccionada no existe.'
            );
        }

        $item = $carrito->items()
            ->where('producto_id', $producto->id)
            ->where('color', $request->color)
            ->where('talle', $request->talle)
            ->first();

        $cantidadTotal =
            ($item?->cantidad ?? 0)
            + $request->cantidad;

        if ($cantidadTotal > $variante->stock) {

            return back()->with(
                'error',
                'Stock insuficiente.'
            );
        }

        if ($item) {

            $item->cantidad = $cantidadTotal;
            $item->save();

        } else {

            $carrito->items()->create([
                'producto_id' => $producto->id,
                'cantidad'    => $request->cantidad,
                'precio'      => $producto->precio,
                'color'       => $request->color,
                'talle'       => $request->talle,
            ]);
        }

        return back()->with('open_cart', true);
    }

    public function actualizar(Request $request, $id)
    {
        $item = CarritoItem::findOrFail($id);

        $cantidad = max(
            1,
            (int) $request->cantidad
        );

        $variante = ProductoVariante::where(
            'producto_id',
            $item->producto_id
        )
        ->whereHas('color', function ($q) use ($item) {
            $q->where('nombre', $item->color);
        })
        ->whereHas('talle', function ($q) use ($item) {
            $q->where('nombre', $item->talle);
        })
        ->first();

        if ($variante && $cantidad > $variante->stock) {

            return back()->with(
                'error',
                'Stock insuficiente.'
            );
        }

        $item->cantidad = $cantidad;
        $item->save();

        return back()->with('open_cart', true);
    }

    public function eliminar($id)
    {
        CarritoItem::findOrFail($id)->delete();

        return back()->with('open_cart', true);
    }

    public function vaciar()
    {
        $carrito = $this->carrito();

        $carrito->items()->delete();

        return back()->with('open_cart', true);
    }
}
