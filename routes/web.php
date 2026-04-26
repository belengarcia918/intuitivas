<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PruebaController;

Route::get('/', [PruebaController::class, 'principal'])->name('principal');

Route::get('/contacto', [PruebaController::class, 'contacto'])->name('contacto');

/* Lista de productos */
Route::get('/productos', [PruebaController::class, 'verCatalogo'])
    ->name('productos.index');

/* Por categoria */
Route::get('/productos/categoria/{categoria}', [PruebaController::class, 'categoria'])
    ->name('productos.categoria');

/* Detalle de producto */
Route::get('/productos/{id}', [PruebaController::class, 'mostrarProducto'])
    ->name('productos.show');

Route::get('/comercializacion', [PruebaController::class, 'comercializacion'])->name('comercializacion');

Route::get('/quienes-somos', [PruebaController::class, 'quienes_somos'])->name('quienes_somos');

