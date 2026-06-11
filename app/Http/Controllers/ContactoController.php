<?php

namespace App\Http\Controllers;
use App\Http\Requests\ContactoRequest;

use Illuminate\Http\Request;

class ContactoController extends Controller
{
    public function store_contacto (ContactoRequest $request){
        $datos = $request->validated();

        $nombre = $datos['nombre'];
        $email = $datos['email'];
        $motivo = $datos['motivo'];
        $consulta = $datos['consulta'];

        //guardar en BD

        return redirect()->back()->with([
            'success_message' => 'Tu consulta ha sido enviada correctamente',
            'nombre' => $nombre,
            'email' => $email
        ]);
    }
}
