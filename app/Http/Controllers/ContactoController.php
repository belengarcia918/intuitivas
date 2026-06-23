<?php

namespace App\Http\Controllers;

use App\Http\Requests\ContactoRequest;
use App\Models\Contacto;
use App\Models\Usuario;

class ContactoController extends Controller
{
    /**
     * Muestra el formulario de contacto en el Frontend público.
     */
    public function index()
    {
        // Busca y renderiza el Blade en resources/views/frontend/contacto.blade.php
        return view('frontend.contacto'); 
    }

    /**
     * Procesa, valida mediante FormRequest y guarda la consulta en MariaDB.
     */
    public function store_contacto(ContactoRequest $request)
    {
        $datos = $request->validated();

        // Inserción real en la base de datos
        Contacto::create($datos);

        // Retorna a la página anterior con los datos en sesión para el Toast de JS
        return redirect()->back()->with([
            'success_message' => 'Tu consulta ha sido enviada correctamente',
            'nombre'          => $datos['nombre'],
            'email'           => $datos['email']
        ]);
    }

    /**
     * Muestra el listado de consultas en el Backend administrativo (estilo maqueta del profesor).
     */
    public function indexAdmin()
    {
        $consultas = Contacto::latest()->get();

        $usuarios = Usuario::latest()->get();

        $cantidadAdmins = Usuario::where('rol', 'admin')->count();

        return view('backend.ver_contactos', compact('consultas', 'usuarios', 'cantidadAdmins'));
    }

    /**
     * Modifica el estado booleano de la consulta a leída (true) de forma segura.
     */
    public function marcarComoLeido($id)
    {
        $contacto = Contacto::findOrFail($id);
        $contacto->leido = true;
        $contacto->save();

        return redirect()->back()->with('success', 'La consulta ha sido marcada como leída 👍');
    }

    public function show($id)
    {
        $consulta = Contacto::findOrFail($id);

        if (!$consulta->leido) {
            $consulta->update(['leido' => true]);
        }

        return view('backend.contactos.show', compact('consulta'));
    }
}
