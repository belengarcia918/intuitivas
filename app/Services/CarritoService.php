<?php

namespace App\Services;

use App\Models\Carrito;

class CarritoService
{
    public static function obtener()
    {
        $sessionId = session()->getId();

        if (auth()->check()) {

            // 1. carrito del usuario (o crearlo)
            $carritoUsuario = Carrito::firstOrCreate([
                'usuario_id' => auth()->id()
            ]);

            // 2. carrito de sesión (invitado)
            $carritoSesion = Carrito::where('session_id', $sessionId)
                ->with('items')
                ->first();

            // 3. MIGRAR carrito de invitado SIEMPRE si existe
            if ($carritoSesion) {

                foreach ($carritoSesion->items as $item) {

                    $existente = $carritoUsuario->items()
                        ->where('producto_id', $item->producto_id)
                        ->where('color', $item->color)
                        ->where('talle', $item->talle)
                        ->first();

                    if ($existente) {
                        $existente->cantidad += $item->cantidad;
                        $existente->save();
                    } else {
                        $carritoUsuario->items()->create([
                            'producto_id' => $item->producto_id,
                            'cantidad'    => $item->cantidad,
                            'precio'      => $item->precio,
                            'color'       => $item->color,
                            'talle'       => $item->talle,
                        ]);
                    }
                }

                // limpiar invitado
                $carritoSesion->items()->delete();
                $carritoSesion->delete();
            }

            return $carritoUsuario;
        }

        // invitado
        return Carrito::firstOrCreate([
            'session_id' => $sessionId,
        ]);
    }

    public static function obtenerItemsConTotales(Carrito $carrito)
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

    public static function migrarDesdeSesion($sessionIdAnterior)
    {
        if (!auth()->check()) return;

        $carritoSesion = Carrito::where('session_id', $sessionIdAnterior)
            ->with('items')
            ->first();

        if (!$carritoSesion) return;

        $carritoUsuario = Carrito::firstOrCreate([
            'usuario_id' => auth()->id()
        ]);

        foreach ($carritoSesion->items as $item) {

            $existente = $carritoUsuario->items()
                ->where('producto_id', $item->producto_id)
                ->where('color', $item->color)
                ->where('talle', $item->talle)
                ->first();

            if ($existente) {
                $existente->cantidad += $item->cantidad;
                $existente->save();
            } else {
                $carritoUsuario->items()->create([
                    'producto_id' => $item->producto_id,
                    'cantidad'    => $item->cantidad,
                    'precio'      => $item->precio,
                    'color'       => $item->color,
                    'talle'       => $item->talle,
                ]);
            }
        }

        $carritoSesion->items()->delete();
        $carritoSesion->delete();
    }
}