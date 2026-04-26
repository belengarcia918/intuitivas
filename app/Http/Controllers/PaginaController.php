<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaController extends Controller
{
    public function principal (){
        return view('frontend.principal');
    }

    public function contacto (){
        return view('frontend.contacto');
    }

    
    public function comercializacion(){
    return view('frontend.comercializacion');
    }

    public function quienes_somos(){
    return view('frontend.quienes_somos');
    }
}

