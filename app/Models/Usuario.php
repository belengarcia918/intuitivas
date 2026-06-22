<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = 'usuarios';

    protected $fillable = [
        'name',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'password',
        'rol',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function ventas()
    {
        return $this->hasMany(VentaCabecera::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasManyThrough(
            VentaDetalle::class,
            VentaCabecera::class,
            'usuario_id', // FK en cabecera
            'venta_id',   // FK en detalle
            'id',         // PK usuario
            'id'          // PK cabecera
        );
    }

    
    /* Helpers */
    public function esAdmin(): bool
    {
        return $this->rol === 'admin';
    }

    public function esCliente(): bool
    {
        return $this->rol === 'cliente';
    }
}
