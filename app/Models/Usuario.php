<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable; 
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Usuario extends Authenticatable
{
    use HasFactory, Notifiable, SoftDeletes;

    // Vinculación a tu tabla en MariaDB
    protected $table = 'usuarios';

    // Campos autorizados para la asignación masiva
    protected $fillable = [
        'name',
        'apellido',
        'email',
        'telefono',
        'direccion',
        'password',
        'rol', // 'admin' o 'cliente'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        // Quitamos 'password' => 'hashed' para no duplicar la encriptación con tu Hash::make en el controlador
    ];

    public function ventas() {
        return $this->hasMany(VentaCabecera::class, 'usuario_id');
    }

    public function detalles()
    {
        return $this->hasManyThrough(
            VentaDetalle::class,
            VentaCabecera::class,
            'usuario_id',
            'venta_id'
        );
    }
}
