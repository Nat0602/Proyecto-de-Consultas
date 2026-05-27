<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class InventarioController extends Controller
{
    public function index()
    {

        $inicio = session('inicio');
        $fin = session('fin');

        $criticos = DB::table('STOCK')
            ->join('PRODUCTOS', 'STOCK.Product_id', '=', 'PRODUCTOS.id')
            ->where('STOCK.Cantidad', '<', 5);

        if($inicio && $fin){

            $criticos->whereBetween(
                'STOCK.Fecha',
                [$inicio, $fin]
            );

        }

        $criticos = $criticos->get();

        $sobrestock = DB::table('STOCK')
            ->join('PRODUCTOS', 'STOCK.Product_id', '=', 'PRODUCTOS.id')
            ->where('STOCK.Cantidad', '>', 100);

        if($inicio && $fin){

            $sobrestock->whereBetween(
                'STOCK.Fecha',
                [$inicio, $fin]
            );

        }

        $sobrestock = $sobrestock->get();

        return view('inventario.index', compact(
            'criticos',
            'sobrestock'
        ));
    }
}