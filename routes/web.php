<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\ContactoController;

Route::get('/', [PruebaController::class, 'principal'])->name('principal');

Route::get('/contacto', [PruebaController::class, 'contacto'])->name('contacto');

Route::get('/comercializacion', [PruebaController::class, 'comercializacion'])->name('comercializacion');

Route::get('/quienes-somos', [PruebaController::class, 'quienesSomos'])->name('quienes_somos');

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
