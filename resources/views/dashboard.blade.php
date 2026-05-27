@extends('layouts.app')

@section('content')

<h2 class="mb-4">Menu General</h2>

<div class="row mb-4">

    <div class="col-md-3">
        <div class="card card-kpi p-3">
            <h5>Ventas Totales</h5>
            <h2>{{ $ventasTotales }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-kpi p-3">
            <h5>Productos Vendidos</h5>
            <h2>{{ $productosVendidos }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-kpi p-3">
            <h5>Facturas</h5>
            <h2>{{ $facturas }}</h2>
        </div>
    </div>

    <div class="col-md-3">
        <div class="card card-kpi p-3">
            <h5>Stock</h5>
            <h2>{{ $stock }}</h2>
        </div>
    </div>

</div>

<div class="row">

    <div class="col-md-6">
        <div class="chart-container">
            <canvas id="ventasChart"></canvas>
        </div>
    </div>

    <div class="col-md-6">
        <div class="chart-container">
            <canvas id="stockChart"></canvas>
        </div>
    </div>

</div>
<div class="alert alert-danger">

    <h5>Productos críticos</h5>

    @foreach($alertas as $alerta)

        <div class="alert alert-danger mb-2">

            <strong>{{ $alerta->Nombre }}</strong>

            tiene stock crítico:
            
            {{ $alerta->stock_minimo }} unidades

        </div>

    @endforeach

</div>

<script>

const ventasChart = new Chart(
    document.getElementById('ventasChart'),
    {
        type: 'bar',
        data: {
            labels: @json($productos),
            datasets: [{
                label: 'Ventas',
                data: @json($ventas),
                borderWidth: 1
            }]
        }
    }
);

const stockChart = new Chart(
    document.getElementById('stockChart'),
    {
        type: 'pie',
        data: {
            labels: @json($stockProductos),
            datasets: [{
                data: @json($stockCantidades)
            }]
        }
    }
);

</script>

@endsection