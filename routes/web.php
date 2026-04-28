<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ContactoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\CarritoController;



Route::get('/', [ProductoController::class, 'principal'])->name('principal');

Route::get('/contacto', [PruebaController::class, 'contacto'])->name('contacto');

Route::get('/comercializacion', [PruebaController::class, 'comercializacion'])->name('comercializacion');

Route::get('/quienes-somos', [PruebaController::class, 'quienesSomos'])->name('quienes_somos');

Route::get('/terminos_de_uso', [PruebaController::class, 'terminosDeUso'])->name('terminos_de_uso');

Route::get('/cuenta_nueva', [PruebaController::class, 'cuentaNueva'])->name('cuenta_nueva');

Route::get('/login', [PruebaController::class, 'login'])->name('login');

/* Lista de productos */
Route::get('/productos', [ProductoController::class, 'verCatalogo'])
    ->name('productos.index');

/* Por categoria */
Route::get('/productos/categoria/{categoria}', [ProductoController::class, 'categoria'])
    ->name('productos.categoria');

/* Detalle de producto */
Route::get('/productos/{id}', [ProductoController::class, 'mostrarProducto'])
    ->name('productos.show');

Route::post('/contacto', [ContactoController::class, 'procesar'])->name('exito');

Route::post('/nueva_cuenta', [UsuarioController::class, 'registrar']);

Route::post('/login', [UsuarioController::class, 'ingresar']);

/* Carrito */
Route::post('/carrito/agregar', [CarritoController::class, 'agregar'])->name('carrito.agregar');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');

Route::post('/carrito/eliminar', [CarritoController::class, 'eliminar'])->name('carrito.eliminar');

Route::post('/carrito/actualizar', [CarritoController::class, 'actualizar'])->name('carrito.actualizar');

