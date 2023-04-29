<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PagesController extends Controller
{
    public function inicio()
    {
        return view('comienzo');
    }

    public function verPerfil()
    {
        return view('miPerfil');
    }

    public function crearCoche()
    {
        return view('crearCoche');
    }
    public function editarCoche()
    {
        return view('editarCoche2');
    }

    public function crearAccesorio()
    {
        return view('crearAccesorio');
    }
    public function editarAccesorio()
    {
        return view('editarAccesorio2');
    }
    public function verAccesorio()
    {
        return view('mostrarAccesorio2');
    }
    public function verCoche()
    {
        return view('mostrarCoche2');
    }
}
