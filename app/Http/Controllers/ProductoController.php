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
use App\Http\Requests\GestionarImagenesProductoRequest;

class ProductoController extends Controller
{
    /* FRONTEND */

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
            'variantes' => function ($q) {
                $q->withoutTrashed();
            },
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

    /* ADMIN - LISTADO */

    public function listarProductos()
    {
        $productos = Producto::with([
            'categoria',
            'variantes' => function ($q) {
                $q->withoutTrashed();
            },
            'variantes.color',
            'variantes.talle'
        ])
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

    /* CREATE */

    public function create()
    {
        return view('backend.productos.agregar_producto', [
            'categorias' => Categoria::all(),
            'colores'    => Color::all(),
            'talles'     => Talle::all()
        ]);
    }

    /* MÉTODOS DE CREACIÓN RÁPIDA */

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

    /* STORE */

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

            $combinaciones = [];

            foreach ($request->variantes as $variante) {

                $clave =
                    strtolower(trim($variante['color_nombre']))
                    . '-'
                    . $variante['talle_id'];

                if (in_array($clave, $combinaciones)) {

                    return back()
                        ->withInput()
                        ->withErrors([
                            'variantes' =>
                                'No puede haber variantes repetidas.'
                        ]);
                }

                $combinaciones[] = $clave;
            }

            // Variante inicial
            foreach ($request->variantes as $variante) {

                $varianteExiste = $producto->variantes()
                    ->where('color_id', $variante['color_id'])
                    ->where('talle_id', $variante['talle_id'])
                    ->first();

                if ($varianteExiste) {

                    // Si estaba desactivada, la reactivo
                    if ($varianteExiste->trashed()) {
                        $varianteExiste->restore();
                    }

                    // Sumo el stock
                    $varianteExiste->increment(
                        'stock',
                        $variante['stock']
                    );

                } else {

                    // Si no existe, la creo
                    $producto->variantes()->create([
                        'color_id' => $variante['color_id'],
                        'talle_id' => $variante['talle_id'],
                        'stock'    => $variante['stock'],
                    ]);
                }
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
                ->route('admin.productos.listado')
                ->with('success', 'Producto creado correctamente');

        } catch (\Exception $e) {

            DB::rollBack();

            return back()
                ->withInput()
                ->with('error', $e->getMessage());
        }
    }

    /* EDIT */

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

            return back()->withErrors([
                'imagenes' => 'El producto debe tener al menos una imagen.'
            ]);
        }

        Storage::disk('public')->delete($imagen->path);

        $imagen->delete();

        return back()->with(
            'success',
            'Imagen eliminada correctamente.'
        );
    }

    public function imagenes($id)
    {
        $producto = Producto::with('imagenes')
            ->withTrashed()
            ->findOrFail($id);

        return view(
            'backend.productos.gestionar_imagenes',
            compact('producto')
        );
    }

    public function storeImagenes(GestionarImagenesProductoRequest $request, $id)
    {
        $producto = Producto::withTrashed()
            ->findOrFail($id);

        $ultimoOrden = $producto->imagenes()->max('orden') ?? 0;

        foreach ($request->file('imagenes') as $indice => $archivo) {

            $ruta = $archivo->store('productos', 'public');

            $producto->imagenes()->create([
                'path'      => $ruta,
                'orden'     => $ultimoOrden + $indice + 1,
                'principal' => false,
            ]);
        }

        return back()->with(
            'success',
            'Imágenes agregadas correctamente.'
        );
    }

    /* UPDATE */

    public function update(EditarProductoRequest $request, $id)
{

        $producto = Producto::withTrashed()->findOrFail($id);

        $combinaciones = [];

        foreach ($request->variantes as $variante) {

            $clave = $variante['color_id'] . '-' . $variante['talle_id'];

            if (in_array($clave, $combinaciones)) {

                return back()
                    ->withInput()
                    ->withErrors([
                        'variantes' => 'No puede haber dos variantes con el mismo color y talle.'
                    ]);
            }

            $combinaciones[] = $clave;
        }

        DB::transaction(function () use ($request, $producto) {

            $producto->update([
                'nombre'       => $request->nombre,
                'descripcion'  => $request->descripcion,
                'precio'       => $request->precio,
                'categoria_id' => $request->categoria_id,
            ]);

            $idsProcesados = [];

            foreach ($request->variantes as $variante) {

                // EXISTE → actualizar
                if (!empty($variante['id'])) {

                    $v = ProductoVariante::withTrashed()->find($variante['id']);

                    if ($v) {

                        if ($v->trashed()) {
                            $v->restore();
                        }

                        $v->update([
                            'color_id' => $variante['color_id'],
                            'talle_id' => $variante['talle_id'],
                            'stock'    => $variante['stock'],
                        ]);

                        $idsProcesados[] = $v->id;
                    }

                }
                // NUEVA → crear
                else {

                    $nuevo = $producto->variantes()->create([
                        'color_id' => $variante['color_id'],
                        'talle_id' => $variante['talle_id'],
                        'stock'    => $variante['stock'],
                    ]);

                    $idsProcesados[] = $nuevo->id;
                }
            }
        });

        return redirect()
            ->route('admin.productos')
            ->with('success', 'Producto actualizado correctamente');
}

    /* DELETE / RESTORE */

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

    public function desactivarVariante($id)
    {
        $variante = ProductoVariante::findOrFail($id);

        if (
            $variante->producto
                ->variantes()
                ->withoutTrashed()
                ->count() <= 1
        ) {
            return back()->with(
                'error',
                'El producto debe tener al menos una variante activa.'
            );
        }

        $variante->delete();

        return back()->with(
            'success',
            'Variante desactivada correctamente.'
        );
    }

    public function restoreVariante($id)
    {
        $variante = ProductoVariante::withTrashed()->findOrFail($id);
        $variante->restore();

        return back()->with('success', 'Variante reactivada');
    }
}



