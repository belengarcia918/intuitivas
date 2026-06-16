<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre_producto',
        'descripcion_producto',
        'precio_producto',
        'stock_producto',
        'categoria_id',
        'activo',
    ];

    protected $casts = [
        'precio_producto' => 'decimal:2',
        'stock_producto' => 'integer',
        'activo' => 'boolean',
    ];

    // RELACIONES

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class);
    }

    // (si usás variantes)
    public function variantes()
    {
        return $this->hasMany(ProductoVariante::class);
    }
}
