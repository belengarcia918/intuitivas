<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Contacto extends Model
{
    // Definimos la tabla explicitamente (buena práctica)
    protected $table = 'contactos';

    // Campos que permitimos que se llenen desde el formulario
    protected $fillable = [
        'nombre',
        'email',
        'motivo',
        'consulta',
        'leido'
    ];
}
