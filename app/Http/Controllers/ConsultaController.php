<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConsultaController extends Controller
{

    public function index()
{
    return view(
        'consultas.index',
        [
            'dimension'=>null,
            'resultado'=>collect()
        ]
    );
}

    public function generar(Request $request)
{

    $dimension=$request->dimension;
    $metrica=$request->metrica;
    $orden=$request->orden ?? 'DESC';
    $limite=$request->limite ?? 10;

    $consulta = DB::table('FACT_PROD')
        ->join(
            'PRODUCTOS',
            'FACT_PROD.Producto_id',
            '=',
            'PRODUCTOS.id'
        )
        ->join(
            'FACTURA',
            'FACT_PROD.Factura_id',
            '=',
            'FACTURA.id'
        )
        ->leftJoin(
            'PRECIO',
            'FACT_PROD.Producto_id',
            '=',
            'PRECIO.Producto_id'
        );

    if($request->producto){

        $consulta->where(
            'PRODUCTOS.Nombre',
            'LIKE',
            '%'.$request->producto.'%'
        );

    }

    if($metrica=='ventas'){

        $consulta->select(
            "PRODUCTOS.$dimension",
            DB::raw(
                'SUM(FACT_PROD.Cantidad) as total'
            )
        );

    }

    if($metrica=='ingresos'){

        $consulta->select(
            "PRODUCTOS.$dimension",
            DB::raw(
                'SUM(
                    FACT_PROD.Cantidad *
                    PRECIO.Precio
                ) as total'
            )
        );

    }

    if($metrica=='cantidad_facturas'){

        $consulta->select(
            "PRODUCTOS.$dimension",
            DB::raw(
                'COUNT(DISTINCT FACTURA.id) as total'
            )
        );

    }

    $resultado = $consulta
        ->groupBy(
            "PRODUCTOS.$dimension"
        )
        ->orderBy(
            'total',
            $orden
        )
        ->limit($limite)
        ->get();

    return view(
        'consultas.index',
        compact(
            'resultado',
            'dimension'
        )
    );

}

}
