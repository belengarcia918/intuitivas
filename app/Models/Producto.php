<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Producto extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'nombre',
        'descripcion',
        'precio',
        'categoria_id',
        'activo',
    ];

    protected $casts = [
        'precio' => 'decimal:2',
        'activo' => 'boolean',
    ];

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function imagenes()
    {
        return $this->hasMany(ProductoImagen::class);
    }

    public function variantes()
    {
        return $this->hasMany(ProductoVariante::class);
    }

    public function colores()
    {
        return $this->belongsToMany(Color::class, 'producto_variantes');
    }

    public function talles()
    {
        return $this->belongsToMany(Talle::class, 'producto_variantes');
    }

    public function getImagenPrincipalAttribute()
    {
        $principal = $this->imagenes
            ->where('principal', true)
            ->first();

        if ($principal) {
            return $principal->path;
        }

        return $this->imagenes
            ->sortBy('orden')
            ->first()?->path;
    }
}
