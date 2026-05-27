@extends('layouts.app')

@section('content')

<h2 class="mb-4">Módulo Precios</h2>

<div class="chart-container">

    <canvas id="preciosChart"></canvas>

</div>

<script>

new Chart(
    document.getElementById('preciosChart'),
    {
        type: 'line',
        data: {
            labels: @json($precios->pluck('Fecha')),
            datasets: [{
                label: 'Precio',
                data: @json($precios->pluck('Precio'))
            }]
        }
    }
);

</script>

@endsection