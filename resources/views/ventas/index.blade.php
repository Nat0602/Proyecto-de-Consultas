@extends('layouts.app')

@section('content')

<h2 class="mb-4">Módulo Ventas</h2>

<div class="row">

    <div class="col-md-6">
        <div class="chart-container">

            <h5>Top Productos</h5>

            <canvas id="topProductosChart"></canvas>

        </div>
    </div>

    <div class="col-md-6">
        <div class="chart-container">

            <h5>Ventas por Fecha</h5>

            <canvas id="ventasFechaChart"></canvas>

        </div>
    </div>
    
        <div class="chart-container mt-4">

            <h4>Ingresos por Producto</h4>

            <canvas id="ingresosChart"></canvas>

        </div>

</div>

<script>
new Chart(
document.getElementById('ingresosChart'),
{
    type:'bar',

    data:{
        labels:@json(
            $ingresos->pluck('Nombre')
        ),

        datasets:[{
            label:'Ingreso Total',

            data:@json(
                $ingresos->pluck('ingreso_total')
            )
        }]
    }
});    

new Chart(
    document.getElementById('topProductosChart'),
    {
        type: 'bar',
        data: {
            labels: @json($topProductos->pluck('Nombre')),
            datasets: [{
                label: 'Ventas',
                data: @json($topProductos->pluck('total'))
            }]
        }
    }
);

new Chart(
    document.getElementById('ventasFechaChart'),
    {
        type: 'line',
        data: {
            labels: @json($ventasFecha->pluck('periodo')),
            datasets: [{
                label: 'Ventas',
                data: @json($ventasFecha->pluck('ventas'))
            }]
        }
    }
);

</script>

@endsection