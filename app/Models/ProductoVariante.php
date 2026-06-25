<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductoVariante extends Model
{
    use SoftDeletes;
    
    protected $table = 'producto_variantes';
    
    protected $fillable = [
        'producto_id',
        'color_id',
        'talle_id',
        'stock',
    ];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }

    public function color()
    {
        return $this->belongsTo(Color::class);
    }

    public function talle()
    {
        return $this->belongsTo(Talle::class);
    }
}
