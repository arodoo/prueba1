<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function index() {
        return view('landing.pages.index');
    }

    public function catalogo(){
        return view('landing.pages.catalogo');
    }

    public function mision(){
        return view('landing.pages.misionVision');
    }

    public function acerca(){
        return view('landing.pages.quienesSomos');
    }

    public function contacto(){
        return view('landing.pages.contactanos');
    }
}
