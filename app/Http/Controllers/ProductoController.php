<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use App\Models\ProductoImagen;
use Illuminate\Http\Request;

class ProductoController extends Controller
{
    /* =====================================================
    | FRONTEND
    ===================================================== */

    public function principal()
    {
        $ultimosProductos = Producto::with(['categoria', 'imagenes'])
            ->where('activo', true)
            ->latest()
            ->take(8)
            ->get();

        return view('frontend.principal', compact('ultimosProductos'));
    }

    public function catalogo()
    {
        $productos = Producto::with(['categoria', 'imagenes'])
            ->where('activo', true)
            ->latest()
            ->get();

        $categorias = Categoria::all();

        return view('frontend.productos.index', compact('productos', 'categorias'));
    }

    public function categoria($categoriaId)
    {
        $categoria = Categoria::findOrFail($categoriaId);

        $productos = Producto::with(['categoria', 'imagenes'])
            ->where('categoria_id', $categoriaId)
            ->where('activo', true)
            ->latest()
            ->get();

        return view('frontend.productos.index', compact('productos', 'categoria'));
    }

    public function show($id)
    {
        $producto = Producto::with(['categoria', 'imagenes', 'variantes.color', 'variantes.talle'])
            ->findOrFail($id);

        return view('frontend.productos.show', compact('producto'));
    }

    /* =====================================================
    | BACKEND (ADMIN)
    ===================================================== */

    public function index()
    {
        $productos = Producto::withTrashed()
            ->with(['categoria', 'imagenes', 'variantes.color', 'variantes.talle'])
            ->latest()
            ->get();

        return view('backend.productos.gestionar_productos', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all();

        return view('backend.productos.agregar_producto', compact('categorias'));
    }

    /* =====================================================
    | STORE (CORREGIDO CON VARIANTES)
    ===================================================== */

    public function store(Request $request)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'precio_producto' => 'required|numeric',
            'categoria_id'    => 'required|exists:categorias,id',

            'color_id' => 'required|exists:colores,id',
            'talle_id' => 'required|exists:talles,id',
            'stock'    => 'required|integer|min:0',

            'imagenes.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        // 1. CREAR PRODUCTO
        $producto = Producto::create([
            'nombre_producto' => $request->nombre_producto,
            'descripcion_producto' => $request->descripcion_producto,
            'precio_producto' => $request->precio_producto,
            'stock_producto' => null,
            'categoria_id' => $request->categoria_id,
            'activo' => true,
        ]);

        // 2. CREAR VARIANTE (COLOR + TALLE + STOCK)
        $producto->variantes()->create([
            'color_id' => $request->color_id,
            'talle_id' => $request->talle_id,
            'stock' => $request->stock,
        ]);

        // 3. IMÁGENES
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {

                $ruta = $imagen->store('productos', 'public');

                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'ruta' => $ruta,
                ]);
            }
        }

        return redirect()
            ->route('admin.productos')
            ->with('success-message', 'Producto creado correctamente');
    }

    /* =====================================================
    | EDIT
    ===================================================== */

    public function edit($id)
    {
        $producto = Producto::withTrashed()
            ->with(['imagenes', 'variantes'])
            ->findOrFail($id);

        $categorias = Categoria::all();

        return view('backend.productos.editar_producto', compact('producto', 'categorias'));
    }

    /* =====================================================
    | UPDATE (CORREGIDO)
    ===================================================== */

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre_producto' => 'required|string|max:255',
            'precio_producto' => 'required|numeric',
            'categoria_id'    => 'required|exists:categorias,id',

            'color_id' => 'required|exists:colores,id',
            'talle_id' => 'required|exists:talles,id',
            'stock'    => 'required|integer|min:0',

            'imagenes.*' => 'image|mimes:jpg,jpeg,png,webp|max:2048',
        ]);

        $producto = Producto::withTrashed()->findOrFail($id);

        // actualizar producto
        $producto->update([
            'nombre_producto' => $request->nombre_producto,
            'descripcion_producto' => $request->descripcion_producto,
            'precio_producto' => $request->precio_producto,
            'categoria_id' => $request->categoria_id,
        ]);

        // actualizar o crear variante
        $producto->variantes()->updateOrCreate(
            [
                'color_id' => $request->color_id,
                'talle_id' => $request->talle_id,
            ],
            [
                'stock' => $request->stock,
            ]
        );

        // imágenes nuevas
        if ($request->hasFile('imagenes')) {
            foreach ($request->file('imagenes') as $imagen) {

                $ruta = $imagen->store('productos', 'public');

                ProductoImagen::create([
                    'producto_id' => $producto->id,
                    'ruta' => $ruta,
                ]);
            }
        }

        return redirect()
            ->route('admin.productos')
            ->with('success-message', 'Producto actualizado correctamente');
    }

    /* =====================================================
    | DELETE / RESTORE
    ===================================================== */

    public function destroy(Producto $producto)
    {
        $producto->delete();

        return redirect()
            ->route('admin.productos')
            ->with('success-message', 'Producto eliminado correctamente');
    }

    public function restore($id)
    {
        $producto = Producto::withTrashed()->findOrFail($id);
        $producto->restore();

        return redirect()
            ->route('admin.productos')
            ->with('success-message', 'Producto restaurado correctamente');
    }

    /* =====================================================
    | CUSTOM LIST
    ===================================================== */

    public function listarProductosCustom()
    {
        $productos = Producto::withTrashed()
            ->with(['categoria', 'imagenes', 'variantes'])
            ->latest()
            ->get();

        return view('backend.productos.listar_productos', compact('productos'));
    }
}



