<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function principal (){
        return view('frontend.principal');
    }

    public function contacto (){
        return view('frontend.contacto');
    }

    public function quienesSomos (){
        return view('frontend.quienes_somos');
    }

    public function comercializacion (){
        return view('frontend.comercializacion');
    }

    public function terminosDeUso (){
        return view('frontend.terminos_de_uso');
    }

    public function cuentaNueva (){
        return view('frontend.cuenta_nueva');
    }

    public function login (){
        return view('frontend.login');
    }

}