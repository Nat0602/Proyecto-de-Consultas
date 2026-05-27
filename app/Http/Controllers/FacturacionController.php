<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class FacturacionController extends Controller
{
    public function index()
    {

        // FILTROS GLOBALES
        $inicio = session('inicio');
        $fin = session('fin');

        $clientes = DB::table('FACTURA')
            ->select(
                'CC_comprador_hash',
                DB::raw('COUNT(*) as compras')
            );

        // APLICAR FILTRO
        if($inicio && $fin){

            $clientes->whereBetween(
                'FACTURA.Fecha',
                [$inicio, $fin]
            );

        }

        $clientes = $clientes
            ->groupBy('CC_comprador_hash')
            ->orderByDesc('compras')
            ->limit(10)
            ->get();

        return view(
            'facturacion.index',
            compact('clientes')
        );
    }
}