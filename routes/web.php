<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\VentasController;
use App\Http\Controllers\InventarioController;
use App\Http\Controllers\PreciosController;
use App\Http\Controllers\FacturacionController;
use App\Http\Controllers\FiltroController;
use App\Http\Controllers\ConsultaController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/', [DashboardController::class, 'index']);
Route::get('/', [DashboardController::class, 'index']);
Route::get('/ventas', [VentasController::class, 'index']);
Route::get('/inventario', [InventarioController::class, 'index']);
Route::get('/precios', [PreciosController::class, 'index']);
Route::get('/facturacion', [FacturacionController::class, 'index']);
Route::post('/filtros', [FiltroController::class, 'guardar']);
Route::get('/filtros/limpiar', [FiltroController::class, 'limpiar']);
Route::get('/consultas',[ConsultaController::class,'index']);
Route::post('/consultas',[ConsultaController::class,'generar']);