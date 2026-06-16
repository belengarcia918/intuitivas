<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\{
    PruebaController,
    ProductoController,
    ContactoController,
    CarritoController,
    AuthController,
    AdminController,
    ClienteController,
    VentaController,
    CompraController
};

/* =====================================================
| 1. FRONTEND
===================================================== */

// HOME
Route::get('/', [ProductoController::class, 'principal'])->name('home');

// CATÁLOGO
Route::get('/productos', [ProductoController::class, 'catalogo'])
    ->name('productos.index');

// CATEGORÍA
Route::get('/categoria/{categoria}', [ProductoController::class, 'porCategoria'])
    ->name('productos.categoria');

// DETALLE
Route::get('/productos/{producto}', [ProductoController::class, 'show'])
    ->name('productos.show');

// CONTACTO
Route::get('/contacto', [ContactoController::class, 'index'])->name('contacto');
Route::post('/contacto', [ContactoController::class, 'store_contacto']);

// PÁGINAS
Route::get('/comercializacion', [PruebaController::class, 'comercializacion'])->name('comercializacion');
Route::get('/quienes-somos', [PruebaController::class, 'quienesSomos'])->name('quienes_somos');
Route::get('/terminos-de-uso', [PruebaController::class, 'terminosDeUso'])->name('terminos_de_uso');

// CARRITO
Route::prefix('carrito')->group(function () {
    Route::get('/', [CarritoController::class, 'index'])->name('carrito.index');
    Route::post('/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');
    Route::post('/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');
    Route::post('/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');
});


/* =====================================================
| 2. AUTENTICACIÓN
===================================================== */

Route::middleware('guest')->group(function () {
    Route::get('/login', [AuthController::class, 'formularioLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'autenticar']);

    Route::get('/registro', [AuthController::class, 'formularioRegistro'])->name('registro');
    Route::post('/registro', [AuthController::class, 'registrar']);
});

Route::post('/logout', [AuthController::class, 'logout'])
    ->name('logout')
    ->middleware('auth');


/* =====================================================
| 3. ADMIN
===================================================== */

Route::middleware(['auth', 'rol:admin'])
    ->prefix('admin')
    ->group(function () {

        // Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])
            ->name('admin.dashboard');

        // Contactos
        Route::get('/contactos', [ContactoController::class, 'indexAdmin'])
            ->name('admin.contactos');

        Route::patch('/contactos/{id}/leer', [ContactoController::class, 'marcarComoLeido'])
            ->name('admin.contactos.leer');

        // Ventas
        Route::get('/ventas', [VentaController::class, 'index'])
            ->name('admin.ventas');

        // PRODUCTOS
        Route::get('/productos', [ProductoController::class, 'index'])
            ->name('admin.productos');

        Route::get('/productos/listar', [ProductoController::class, 'listarProductosCustom'])
            ->name('admin.productos.listar');

        Route::get('/productos/agregar', [ProductoController::class, 'create'])
            ->name('admin.productos.create');

        Route::post('/productos', [ProductoController::class, 'store'])
            ->name('admin.productos.store');

        // USAR MODEL BINDING
        Route::get('/productos/{producto}/editar', [ProductoController::class, 'edit'])
            ->name('admin.productos.edit');

        Route::put('/productos/{producto}', [ProductoController::class, 'update'])
            ->name('admin.productos.update');

        Route::delete('/productos/{producto}', [ProductoController::class, 'destroy'])
            ->name('admin.productos.delete');

        Route::put('/productos/{producto}/restore', [ProductoController::class, 'restore'])
            ->name('admin.productos.restore');

        // Usuarios
        Route::get('/usuarios', [AuthController::class, 'indexUsuarios'])
            ->name('admin.usuarios');

        Route::post('/usuarios/{id}/cambiar-rol', [AuthController::class, 'cambiarRol'])
            ->name('admin.usuarios.rol');

        Route::delete('/usuarios/{id}', [AuthController::class, 'destroyUsuario'])
            ->name('admin.usuarios.delete');
});


/* =====================================================
| 4. CLIENTE
===================================================== */

Route::middleware(['auth', 'rol:cliente'])
    ->prefix('cliente')
    ->group(function () {

        Route::get('/', [ClienteController::class, 'dashboard'])
            ->name('cliente.dashboard');

        Route::post('/confirmar', [CompraController::class, 'confirmar_compra'])
            ->name('cliente.confirmar');
});