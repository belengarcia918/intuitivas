<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Usuario;
use App\Models\Producto;
use App\Models\VentaCabecera;
use App\Models\VentaDetalle;
use App\Models\Contacto;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    /* DASHBOARD */
    public function dashboard()
    {
        return view('backend.admin.dashboard', [

            /* =========================
            MÉTRICAS
            ========================= */
            'totalProductos' => Producto::count(),
            'totalClientes'  => Usuario::where('rol', 'cliente')->count(),

            'ventasHoy' => VentaCabecera::whereDate('fecha_venta', today())->sum('total'),

            'ventasMes' => VentaCabecera::whereMonth('fecha_venta', now()->month)
                ->whereYear('fecha_venta', now()->year)
                ->sum('total'),

            'cantidadVentasHoy' => VentaCabecera::whereDate('fecha_venta', today())->count(),

            'ticketPromedio' => VentaCabecera::avg('total'),

            /* =========================
            ÚLTIMAS VENTAS
            ========================= */
            'ultimasVentas' => VentaCabecera::with('usuario')
                ->latest('fecha_venta')
                ->take(5)
                ->get(),

            /* =========================
            CONTACTOS
            ========================= */
            'ultimosContactos' => Contacto::latest()
                ->take(5)
                ->get(),

            /* =========================
            STOCK BAJO
            ========================= */
            'productosBajoStock' => Producto::whereHas('variantes', function ($q) {
                    $q->where('stock', '<', 5);
                })
                ->with('variantes')
                ->take(5)
                ->get(),

            /* =========================
            TOP PRODUCTOS (REAL)
            ========================= */
            'topProductos' => VentaDetalle::select(
                    'producto_id',
                    DB::raw('SUM(cantidad) as total_vendidos')
                )
                ->whereHas('venta', function ($q) {
                    $q->where('estado', 'confirmado');
                })
                ->with('producto')
                ->groupBy('producto_id')
                ->orderByDesc('total_vendidos')
                ->take(5)
                ->get(),
        ]);
    }

    /* USUARIOS */
    public function usuarios(Request $request)
    {
        $buscar = $request->buscar;

        $usuarios = Usuario::withTrashed()
            ->when($buscar, function ($query) use ($buscar) {
                $query->where('name', 'like', "%{$buscar}%")
                    ->orWhere('email', 'like', "%{$buscar}%");
            })
            ->get()
            ->groupBy('rol');

        $cantidadAdmins = Usuario::where('rol', 'admin')
            ->count();

        return view('backend.admin.vistaUsuarios', [
            'administradores' => $usuarios->get('admin', collect()),
            'clientes'        => $usuarios->get('cliente', collect()),
            'cantidadAdmins'  => $cantidadAdmins,
        ]);
    }

    /* CAMBIAR ROL */
    public function cambiarRol(Request $request, $id)
    {
        $this->checkAdmin();

        $request->validate([
            'rol' => 'required|in:admin,cliente'
        ]);

        $usuario = Usuario::withTrashed()->findOrFail($id);

        if ($usuario->id === Auth::id() && $request->rol === 'cliente') {
            return back()->with('error', 'No podés quitarte el rol de admin');
        }

        $usuario->update([
            'rol' => $request->rol
        ]);

        return back()->with('success', 'Rol actualizado correctamente');
    }

    /* ELIMINAR / RESTAURAR */
    public function destroy($id)
    {
        $this->checkAdmin();

        $usuario = Usuario::withTrashed()->findOrFail($id);

        if ($usuario->id === Auth::id()) {
            return back()->with('error', 'No podés eliminarte a vos mismo');
        }

        if ($usuario->rol === 'admin' && Usuario::where('rol', 'admin')->count() <= 1) {
            return back()->with('error', 'Debe existir al menos un admin');
        }

        if ($usuario->trashed()) {
            $usuario->restore();
            return back()->with('success', 'Usuario restaurado');
        }

        $usuario->delete();

        return back()->with('success', 'Usuario desactivado');
    }

    /* PROTECCIÓN */
    private function checkAdmin()
    {
        if (!Auth::check() || Auth::user()->rol !== 'admin') {
            abort(403);
        }
    }
}
