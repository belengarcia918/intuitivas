<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class VentaCabecera extends Model 
{ 
    use HasFactory;

    // Vinculación exacta a tu tabla migrada
    protected $table = 'venta_cabeceras'; 

    protected $fillable = [
        'usuario_id', 
        'estado', 
        'total', 
        'fecha_venta',
        'codigo_postal', 
        'calle', 
        'numero', 
        'barrio', 
        'ciudad', 
        'provincia', 
        'metodo_pago'
    ];

    protected $casts = [
        'fecha_venta' => 'datetime',
        'total' => 'decimal:2'
    ];

    // Relación: Una venta pertenece a un Usuario
    public function usuario() { 
        return $this->belongsTo(Usuario::class, 'usuario_id'); 
    } 

    // Relación: Una venta tiene muchos detalles
    public function detalles() { 
        return $this->hasMany(VentaDetalle::class, 'venta_id'); 
    } 

    // Filtro útil para el Admin
    public function scopeConfirmadas($query) {
        return $query->where('estado', 'confirmado');
    }
}