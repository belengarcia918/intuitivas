<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VentaDetalle extends Model 
{ 
    use HasFactory;

    // Vinculación exacta a tu tabla migrada
    protected $table = 'venta_detalles'; 

    protected $fillable = [
    'venta_id',
    'producto_id',
    'nombre_producto',
    'color',
    'talle',
    'cantidad',
    'precio_unitario',
    'subtotal'
];

    protected $casts = [
        'precio_unitario' => 'decimal:2',
        'subtotal' => 'decimal:2'
    ];

    // Relación: Cada detalle pertenece a una cabecera
    public function venta() { 
        return $this->belongsTo(VentaCabecera::class, 'venta_id'); 
    } 

    // Relación: Un detalle apunta a un producto
    public function producto() { 
        return $this->belongsTo(Producto::class, 'producto_id'); 
    } 
}
