<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $fillable = [
        'nombre',
        'hex',
    ];

    public function productos()
    {
        return $this->belongsToMany(Producto::class, 'producto_variantes');
    }
}
