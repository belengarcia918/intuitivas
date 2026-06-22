<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PruebaController extends Controller
{
    public function quienesSomos (){
        return view('frontend.quienes_somos');
    }

    public function comercializacion (){
        return view('frontend.comercializacion');
    }

    public function terminosDeUso (){
        return view('frontend.terminos_de_uso');
    }
}