<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FiltroController extends Controller
{
    public function guardar(Request $request)
    {

        session([
            'inicio' => $request->inicio,
            'fin' => $request->fin
        ]);

        return back();
    }

    public function limpiar()
    {

        session()->forget([
            'inicio',
            'fin'
        ]);

        return back();
    }
}