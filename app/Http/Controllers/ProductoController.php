<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\Color;
use App\Models\Talle;
use App\Models\ProductoVariante;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\EditarProductoRequest;
use App\Http\Requests\AgregarProductoRequest;

class ProductoController extends Controller
{
    /* =========================
    | FRONTEND
    ========================= */

    public function principal()
    {
        $ultimosProductos = Producto::with(['categoria', 'imagenes'])
            ->where('activo', true)
            ->latest()
            ->take(8)
            ->get();

        $categorias = Categoria::orderBy('nombre')->get();

        return view('frontend.principal', compact('ultimosProductos', 'categorias'));
    }

    public function catalogo()
    {
        $productos = Producto::with([
            'categoria',
            'imagenes'
        ])
        ->where('activo', true)
        ->latest()
        ->get();

        $categorias = Categoria::orderBy('nombre')->get();

        $categoria = null;

        return view(
            'frontend.productos.index',
            compact(
                'productos',
                'categorias',
                'categoria'
            )
        );
    }

    public function categoria($categoriaId)
    {
        $categoria = Categoria::findOrFail($categoriaId);

        $productos = Producto::with([
            'categoria',
            'imagenes'
        ])
        ->where('categoria_id', $categoriaId)
        ->where('activo', true)
        ->latest()
        ->get();

        $categorias = Categoria::orderBy('nombre')->get();

        return view(
            'frontend.productos.index',
            compact(
                'productos',
                'categoria',
                'categorias'
            )
        );
    }

    public function show($id)
    {
        $producto = Producto::with([
            'categoria',
            'imagenes',
            'variantes.color',
            'variantes.talle'
        ])->findOrFail($id);

        $variantesData = $producto->variantes->map(function ($v) {

            return [
                'id'       => $v->id,
                'color_id' => $v->color_id,
                'talle_id' => $v->talle_id,
                'talle'    => $v->talle->nombre,
                'stock'    => $v->stock,
            ];

        })->values();

        return view(
            'frontend.productos.show',
            compact('producto', 'variantesData')
        );
    }

    /* =========================
    | ADMIN - LISTADO
    ========================= */

    public function listarProductos()
    {
        $productos = Producto::with(['categoria', 'variantes.color', 'variantes.talle'])
            ->where('activo', true)
            ->latest()
            ->get();

        return view('backend.productos.listar_productos', compact('productos'));
    }

    public function index()
    {
        $productos = Producto::withTrashed()
            ->with(['categoria', 'variantes.color', 'variantes.talle'])
            ->latest()
            ->get();

        return view('backend.productos.gestionar_productos', compact('productos'));
    }

    /* =========================
    | CREATE
    ========================= */

    public function create()
    {
        return view('backend.productos.agregar_producto', [
            'categorias' => Categoria::all(),
            'colores'    => Color::all(),
            'talles'     => Talle::all()
        ]);
    }

    /* ==========================================================================
    MÉTODOS DE CREACIÓN RÁPIDA
    ========================================================================== */

    public function storeCategoriaRapida(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:50|unique:categorias,nombre']);

        $categoria = Categoria::create(['nombre' => $request->nombre]);

        return response()->json([
            'success' => true,
            'id'      => $categoria->id,
            'nombre'  => $categoria->nombre
        ]);
    }

    public function storeColorRapida(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50|unique:colores,nombre',
            'hex'    => 'required|string|size:7' // Valida formato #000000
        ]);

        $color = Color::create([
            'nombre' => $request->nombre,
            'hex'    => $request->hex
        ]);

        return response()->json([
            'success' => true,
            'id'      => $color->id,
            'nombre'  => $color->nombre
        ]);
    }

    public function storeTalleRapida(Request $request)
    {
        $request->validate(['nombre' => 'required|string|max:10|unique:talles,nombre']);

        $talle = Talle::create(['nombre' => $request->nombre]);

        return response()->json([
            'success' => true,
            'id'      => $talle->id,
            'nombre'  => $talle->nombre
        ]);
    }

    /* =========================
    | STORE
    ========================= */

    public function store(AgregarProductoRequest $request)
    {
        DB::beginTransaction();

        try {

            $producto = Producto::whereRaw(
                'LOWER(nombre) = ?',
                [strtolower(trim($request->nombre))]
            )->first();

            if (!$producto && !$request->hasFile('imagenes')) {

                return back()
                    ->withErrors([
                        'imagenes' => 'Debes subir al menos una imagen para un producto nuevo.'
                    ])
                    ->withInput();
            }

            if (!$producto) {

                $producto = Producto::create([
                    'nombre'       => $request->nombre,
                    'descripcion'  => $request->descripcion,
                    'precio'       => $request->precio,
                    'categoria_id' => $request->categoria_id,
                    'activo'       => true,
                ]);
            }

            // Variante inicial
            $varianteExiste = $producto->variantes()
                ->where('color_id', $request->color_id)
                ->where('talle_id', $request->talle_id)
                ->first();

            if ($varianteExiste) {

                $varianteExiste->increment('stock', $request->stock);

            } else {

                $producto->variantes()->create([
                    'color_id' => $request->color_id,
                    'talle_id' => $request->talle_id,
                    'stock'    => $request->stock,
                ]);
            }

            // Imágenes
            if ($request->hasFile('imagenes')) {

                foreach ($request->file('imagenes') as $indice => $archivo) {

                    $ruta = $archivo->store('productos', 'public');

                    $producto->imagenes()->create([
                        'path'      => $ruta,
                        'orden'     => $indice,
                        'principal' => $indice === 0,
                    ]);
                }
            }

            DB::commit();

            return redirect()
                ->route('admin.productos.index')
                ->with('success', 'Producto creado correctamente');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /* =========================
    | EDIT
    ========================= */

    public function edit($id)
    {
        $producto = Producto::withTrashed()
            ->with(['imagenes', 'variantes'])
            ->findOrFail($id);

        return view('backend.productos.editar_producto', [
            'producto'   => $producto,
            'categorias' => Categoria::all(),
            'colores'    => Color::all(),
            'talles'     => Talle::all()
        ]);
    }

    public function destroyImagen(ProductoImagen $imagen)
    {
        $producto = $imagen->producto;

        if ($producto->imagenes()->count() <= 1) {

            return back()->with(
                'error-message',
                'El producto debe tener al menos una imagen.'
            );
        }

        Storage::disk('public')->delete($imagen->path);

        $imagen->delete();

        return back()->with(
            'success',
            'Imagen eliminada correctamente.'
        );
    }

    /* =========================
    | UPDATE
    ========================= */

    public function update(EditarProductoRequest $request, $id)
    {
        $producto = Producto::withTrashed()->findOrFail($id);

        DB::transaction(function () use ($request, $producto) {

            $producto->update([
                'nombre'       => $request->nombre,
                'descripcion'  => $request->descripcion,
                'precio'       => $request->precio,
                'categoria_id' => $request->categoria_id,
            ]);

            $producto->variantes()->delete();

            foreach ($request->variantes as $variante) {
                $producto->variantes()->create([
                    'color_id' => $variante['color_id'],
                    'talle_id' => $variante['talle_id'],
                    'stock'    => $variante['stock'],
                ]);
            }

            if ($request->hasFile('imagenes')) {

                foreach ($request->file('imagenes') as $indice => $img) {

                    $ruta = $img->store('productos', 'public');

                    $producto->imagenes()->create([
                        'path'      => $ruta,
                        'orden'     => $indice,
                        'principal' => false,
                    ]);
                }
            }
        });

        return redirect()
            ->route('admin.productos.index')
            ->with('success', 'Producto actualizado correctamente');
    }

    /* =========================
    | DELETE / RESTORE
    ========================= */

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return back()->with('success', 'Producto eliminado');
    }

    public function restore($id)
    {
        $producto = Producto::withTrashed()->findOrFail($id);
        $producto->restore();

        return back()->with('success', 'Producto restaurado');
    }

    public function activar($id)
    {
        $producto = Producto::findOrFail($id);

        $producto->update([
            'activo' => true
        ]);

        return back()->with('success', 'Producto activado');
    }

    public function desactivar($id)
    {
        $producto = Producto::findOrFail($id);

        $producto->update([
            'activo' => false
        ]);

        return back()->with('success', 'Producto desactivado');
    }
}



