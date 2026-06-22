<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Color extends Model
{
    protected $table = 'colores';
    
    protected $fillable = ['nombre', 'hex'];

    public function variantes()
    {
        return $this->hasMany(ProductoVariante::class);
    }
}
