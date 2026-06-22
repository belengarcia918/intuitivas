<?php

namespace App\Services;

use App\Models\Carrito;

class CarritoService
{
    public static function obtener()
    {
        if (auth()->check()) {

            $carritoSesion = Carrito::where(
                'session_id',
                session()->getId()
            )->first();

            $carritoUsuario = Carrito::where(
                'usuario_id',
                auth()->id()
            )->first();

            if ($carritoSesion && !$carritoUsuario) {

                $carritoSesion->update([
                    'usuario_id' => auth()->id(),
                    'session_id' => null,
                ]);

                return $carritoSesion;
            }

            if ($carritoUsuario) {
                return $carritoUsuario;
            }

            return Carrito::create([
                'usuario_id' => auth()->id(),
            ]);
        }

        return Carrito::firstOrCreate([
            'session_id' => session()->getId(),
        ]);
    }

    public function obtenerItemsConTotales(Carrito $carrito)
    {
        $items = $carrito->items()
            ->with('producto.imagenes')
            ->get();

        $total = 0;

        $itemsFormateados = $items->map(function ($item) use (&$total) {

            $subtotal = $item->precio * $item->cantidad;

            $total += $subtotal;

            return [
                'id'       => $item->producto_id,
                'nombre'   => $item->producto->nombre,
                'imagen'   => $item->producto->imagen_principal,
                'cantidad' => $item->cantidad,
                'precio'   => $item->precio,
                'subtotal' => $subtotal,
                'color'    => $item->color ?? '-',
                'talle'    => $item->talle ?? '-',
            ];
        });

        return [
            'items' => $itemsFormateados,
            'total' => $total
        ];
    }
}