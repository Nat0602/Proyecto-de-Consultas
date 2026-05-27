@extends('layouts.app')

@section('content')

<h2 class="mb-4">Clientes Frecuentes</h2>

<div class="chart-container">

    <canvas id="clientesChart"></canvas>

</div>

<script>

new Chart(
    document.getElementById('clientesChart'),
    {
        type: 'bar',
        data: {
            labels: @json($clientes->pluck('CC_comprador_hash')),
            datasets: [{
                label: 'Compras',
                data: @json($clientes->pluck('compras'))
            }]
        }
    }
);

</script>

@endsection