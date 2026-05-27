<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class PreciosController extends Controller
{
    public function index()
    {

        $inicio = session('inicio');
        $fin = session('fin');

        $precios = DB::table('PRECIO')
            ->join('PRODUCTOS', 'PRECIO.Producto_id', '=', 'PRODUCTOS.id')
            ->select(
                'PRODUCTOS.Nombre',
                'PRECIO.Fecha',
                'PRECIO.Precio'
            );

        // FILTRO GLOBAL
        if($inicio && $fin){

            $precios->whereBetween(
                'PRECIO.Fecha',
                [$inicio, $fin]
            );

        }

        $precios = $precios
            ->orderBy('PRECIO.Fecha')
            ->get();

        return view('precios.index', compact('precios'));
    }
}
