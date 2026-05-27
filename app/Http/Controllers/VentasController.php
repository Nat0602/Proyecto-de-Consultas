<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class VentasController extends Controller
{
    public function index()
    {

        // FILTROS GLOBALES
        $inicio = session('inicio');
        $fin = session('fin');

        /*
        ======================
        TOP PRODUCTOS
        ======================
        */

        $topProductos = DB::table('FACT_PROD')
            ->join(
                'PRODUCTOS',
                'FACT_PROD.Producto_id',
                '=',
                'PRODUCTOS.id'
            )
            ->select(
                'PRODUCTOS.Nombre',
                DB::raw(
                    'SUM(FACT_PROD.Cantidad) as total'
                )
            );

        if($inicio && $fin){

            $topProductos->whereBetween(
                'FACT_PROD.Fecha',
                [$inicio,$fin]
            );

        }

        $topProductos = $topProductos
            ->groupBy('PRODUCTOS.Nombre')
            ->orderByDesc('total')
            ->limit(10)
            ->get();


        /*
        ======================
        INGRESOS POR PRODUCTO
        ======================
        */

        $ingresos = DB::table('FACT_PROD')
            ->join(
                'PRODUCTOS',
                'FACT_PROD.Producto_id',
                '=',
                'PRODUCTOS.id'
            )
            ->join(
                'PRECIO',
                'FACT_PROD.Producto_id',
                '=',
                'PRECIO.Producto_id'
            )
            ->join(
                'FACTURA',
                'FACT_PROD.Factura_id',
                '=',
                'FACTURA.id'
            )
            ->select(
                'PRODUCTOS.Nombre',
                DB::raw(
                    'SUM(
                        FACT_PROD.Cantidad * PRECIO.Precio
                    ) as ingreso_total'
                )
            );

        if($inicio && $fin){

            $ingresos->whereBetween(
                'FACTURA.Fecha',
                [$inicio,$fin]
            );

        }

        $ingresos = $ingresos
            ->groupBy('PRODUCTOS.Nombre')
            ->orderByDesc('ingreso_total')
            ->limit(10)
            ->get();


        /*
        ======================
        VENTAS POR FECHA
        ======================
        */

        $ventasFecha = DB::table('FACT_PROD')
            ->join(
                'FACTURA',
                'FACT_PROD.Factura_id',
                '=',
                'FACTURA.id'
            )
            ->select(
                DB::raw("
                    DATE_FORMAT(
                        FACTURA.Fecha,
                        '%Y-%m'
                    ) as periodo
                "),
                DB::raw(
                    'SUM(FACT_PROD.Cantidad) as ventas'
                )
            );

        if($inicio && $fin){

            $ventasFecha->whereBetween(
                'FACTURA.Fecha',
                [$inicio,$fin]
            );

        }

        $ventasFecha = $ventasFecha
            ->groupBy('periodo')
            ->orderBy('periodo')
            ->get();


        return view(
            'ventas.index',
            compact(
                'topProductos',
                'ingresos',
                'ventasFecha'
            )
        );

    }
}