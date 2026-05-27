<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {

        $ventasTotales = DB::table('FACT_PROD')->sum('Cantidad');

        $productosVendidos = DB::table('FACT_PROD')
            ->distinct('Producto_id')
            ->count();

        $facturas = DB::table('FACTURA')->count();

        $stock = DB::table('STOCK')->sum('Cantidad');

        $ventasProductos = DB::table('FACT_PROD')
            ->join('PRODUCTOS', 'FACT_PROD.Producto_id', '=', 'PRODUCTOS.id')
            ->select(
                'PRODUCTOS.Nombre',
                DB::raw('SUM(FACT_PROD.Cantidad) as total')
            )
            ->groupBy('PRODUCTOS.Nombre')
            ->get();

        $productos = $ventasProductos->pluck('Nombre');

        $ventas = $ventasProductos->pluck('total');

        $stockData = DB::table('STOCK')
            ->join('PRODUCTOS', 'STOCK.Product_id', '=', 'PRODUCTOS.id')
            ->select(
                'PRODUCTOS.Nombre',
                'STOCK.Cantidad'
            )
            ->get();

        $stockProductos = $stockData->pluck('Nombre');

        $stockCantidades = $stockData->pluck('Cantidad');

        $alertas = DB::table('STOCK')
        ->join('PRODUCTOS', 'STOCK.Product_id', '=', 'PRODUCTOS.id')
        ->select(
            'PRODUCTOS.Nombre',
            DB::raw('MIN(STOCK.Cantidad) as stock_minimo')
        )
        ->where('STOCK.Cantidad', '<', 5)
        ->groupBy('PRODUCTOS.Nombre')
        ->get();

        return view('dashboard', compact(
            'ventasTotales',
            'productosVendidos',
            'facturas',
            'alertas',
            'stock',
            'productos',
            'ventas',
            'stockProductos',
            'stockCantidades'
        ));

    }
}