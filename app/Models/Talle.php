<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Talle extends Model
{
    protected $table = 'talles';
    
    protected $fillable = ['nombre'];

    public function variantes()
    {
        return $this->hasMany(ProductoVariante::class);
    }
}
