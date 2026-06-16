<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\Producto;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use Carbon\Carbon;

class CompraController extends Controller
{
    public function confirmar_compra(Request $request)
    {
        // 1. Validación de datos de envío
        $request->validate([
            'codigo_postal' => 'required', 
            'calle'         => 'required', 
            'numero'        => 'required',
            'barrio'        => 'required', 
            'ciudad'        => 'required', 
            'provincia'     => 'required', 
            'metodo_pago'   => 'required'
        ]);

        $carrito = session()->get('carrito', []);
        if (empty($carrito)) {
            return redirect()->back()->with('error-message', 'El carrito está vacío.');
        }

        // 2. Cálculo del total
        $totalVenta = array_reduce($carrito, function($carry, $item) {
            return $carry + ($item['precio'] * $item['cantidad']);
        }, 0);

        // 3. Inicio de Transacción (Crucial para mantener integridad de datos)
        DB::beginTransaction(); 

        try {
            // Creación de la Cabecera
            $venta = VentaCabecera::create([
                'usuario_id'    => Auth::id(),
                'estado'        => 'confirmado',
                'total'         => $totalVenta,
                'fecha_venta'   => Carbon::now(),
                ...$request->only(['codigo_postal', 'calle', 'numero', 'barrio', 'ciudad', 'provincia', 'metodo_pago'])
            ]);

            // 4. Procesamiento de Detalles y Stock
            foreach ($carrito as $idProducto => $item) {
                $producto = Producto::findOrFail($idProducto);

                // Verificación de stock (Asegurate que el campo en tu tabla sea 'stock_producto')
                if ($producto->stock_producto < $item['cantidad']) {
                    throw new \Exception("Stock insuficiente para: " . $producto->nombre_producto);
                }

                // Registro del detalle
                VentaDetalle::create([
                    'venta_id'        => $venta->id,
                    'producto_id'     => $producto->id,
                    'cantidad'        => $item['cantidad'],
                    'precio_unitario' => $item['precio'],
                    'subtotal'        => $item['precio'] * $item['cantidad']
                ]);

                // Actualización del stock
                $producto->stock_producto -= $item['cantidad'];
                $producto->save();
            }

            // 5. Finalización exitosa
            DB::commit(); 
            session()->forget('carrito');
            
            return redirect()->route('cliente.dashboard')->with('success-message', '¡Compra realizada con éxito!');

        } catch (\Exception $e) {
            // Reversión de cambios ante cualquier error
            DB::rollBack();
            return redirect()->back()->with('error-message', 'Error al procesar la compra: ' . $e->getMessage());
        }
    }
}
