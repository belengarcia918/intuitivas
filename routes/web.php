<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PaginaController;

Route::get('/', [PaginaController::class, 'principal'])->name('principal');

Route::get('/contacto', [PaginaController::class, 'contacto'])->name('contacto');

Route::get('/comercializacion', [PaginaController::class, 'comercializacion'])->name('comercializacion');

Route::get('/quienes-somos', [PaginaController::class, 'quienes_somos'])->name('quienes_somos');