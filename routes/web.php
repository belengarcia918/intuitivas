<?php

use App\Http\Controllers\ProductoController;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\VentaController;
use App\Http\Controllers\ContactoController;
use Illuminate\Support\Facades\Route;


/* HOME */
Route::get('/', [ProductoController::class, 'principal'])->name('principal');

/*  PÁGINAS INFORMATIVAS */
Route::get('/quienes-somos', [PruebaController::class, 'quienesSomos'])->name('quienes_somos');
Route::get('/comercializacion', [PruebaController::class, 'comercializacion'])->name('comercializacion');
Route::get('/terminos-de-uso', [PruebaController::class, 'terminosDeUso'])->name('terminos_de_uso');

/* PRODUCTOS */
Route::get('/productos', [ProductoController::class, 'catalogo'])->name('productos.index');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');
Route::get('/categorias/{categoriaId}', [ProductoController::class, 'categoria'])->name('productos.categoria');

Route::prefix('carrito')->group(function () {

    Route::get('/', [CarritoController::class, 'index'])
        ->name('carrito.index');

    Route::post('/agregar', [CarritoController::class, 'agregar'])
        ->name('carrito.agregar');

    Route::patch('/actualizar/{id}', [CarritoController::class, 'actualizar'])
        ->name('carrito.actualizar');

    Route::delete('/eliminar/{id}', [CarritoController::class, 'eliminar'])
        ->name('carrito.eliminar');

    Route::delete('/vaciar', [CarritoController::class, 'vaciar'])
        ->name('carrito.vaciar');
});

/* AUTH */
Route::get('/login', [UsuarioController::class, 'formularioLogin'])->name('login');
Route::post('/login', [UsuarioController::class, 'ingresar'])->name('login.post');

Route::get('/registro', [UsuarioController::class, 'formularioRegistro'])->name('registro');
Route::post('/registro', [UsuarioController::class, 'registrar'])->name('registro.post');

// Cambiamos Route::post por Route::match para que acepte tanto POST como GET
Route::match(['get', 'post'], '/logout', [UsuarioController::class, 'logout'])->name('logout');

/* CLIENTE (SOLO LOGUEADOS) */
Route::middleware(['auth'])->group(function () {

    Route::get('/cliente', [ClienteController::class, 'dashboard'])
        ->name('perfil');

    Route::get('/perfil/editar', [ClienteController::class, 'editar'])
        ->name('perfil.editar');

    Route::put('/perfil/update', [ClienteController::class, 'update'])
        ->name('perfil.update');

    Route::get('/perfil/compras', [ClienteController::class, 'compras'])
        ->name('perfil.compras');

    Route::get('/checkout', [VentaController::class, 'checkout'])
        ->name('checkout');

    Route::post('/checkout/finalizar', [VentaController::class, 'finalizar'])
        ->name('checkout.finalizar');

    Route::get('/checkout/exito/{venta}', [VentaController::class, 'exito'])
        ->name('checkout.exito');

});

/* ADMIN (SOLO ADMIN) */
Route::prefix('admin')
    ->middleware(['auth', 'rol:admin'])
    ->group(function () {

        Route::get('/', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        /* PRODUCTOS ADMIN */
        Route::get('/productos', [ProductoController::class, 'index'])->name('admin.productos');
        Route::get('/productos/crear', [ProductoController::class, 'create'])->name('admin.productos.create');
        Route::post('/productos', [ProductoController::class, 'store'])->name('admin.productos.store');
        Route::get('/productos/{id}/editar', [ProductoController::class, 'edit'])->name('admin.productos.edit');
        Route::put('/productos/{id}', [ProductoController::class, 'update'])->name('admin.productos.update');
        Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])->name('admin.productos.destroy');
        Route::put('/productos/{id}/restore', [ProductoController::class, 'restore'])->name('admin.productos.restore');
        Route::get('/productos/listado', [ProductoController::class, 'listarProductos'])->name('admin.productos.listado');
        Route::put('/admin/productos/{id}/activar', [ProductoController::class, 'activar'])->name('admin.productos.activar');
        Route::put('/admin/productos/{id}/desactivar', [ProductoController::class, 'desactivar'])->name('admin.productos.desactivar');
        Route::get('/productos/{id}/imagenes', [ProductoController::class, 'imagenes'])->name('admin.productos.imagenes');
        Route::post('/productos/{id}/imagenes', [ProductoController::class, 'storeImagenes'])->name('admin.productos.imagen.store');
        Route::delete('/admin/variantes/{id}', [ProductoController::class, 'desactivarVariante'])->name('admin.variantes.destroy');
        Route::post('/admin/variantes/{id}/restore', [ProductoController::class, 'restoreVariante'])->name('admin.variantes.restore');

        Route::post('/categorias/rapida', [ProductoController::class, 'storeCategoriaRapida'])->name('admin.categorias.rapida');
        Route::post('/colores/rapida', [ProductoController::class, 'storeColorRapida'])->name('admin.colores.rapida');
        Route::post('/talles/rapida', [ProductoController::class, 'storeTalleRapida'])->name('admin.talles.rapida');
        
        Route::delete('/productos/imagenes/{imagen}', [ProductoController::class, 'destroyImagen'])->name('admin.productos.imagen.destroy');
        /* VENTAS */
        Route::get('/ventas', [VentaController::class, 'index'])->name('admin.ventas');

        /* CONTACTOS */
        Route::get('/contactos', [ContactoController::class, 'indexAdmin'])->name('admin.contactos.index');
        Route::patch('/contactos/{id}/leido', [ContactoController::class, 'marcarComoLeido'])->name('admin.contactos.leer');
        Route::get('/admin/contactos/{id}', [ContactoController::class, 'show'])->name('admin.contactos.show');

        /* USUARIOS (ADMIN) */
        Route::get('/usuarios', [AdminController::class, 'usuarios'])->name('admin.usuarios');
        Route::post('/usuarios/{id}/rol', [AdminController::class, 'cambiarRol'])->name('admin.usuarios.rol');
        Route::delete('/usuarios/{id}', [AdminController::class, 'destroy'])->name('admin.usuarios.destroy');
    });

/* CONTACTO (PÚBLICO) */
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'store_contacto'])->name('contacto.store');