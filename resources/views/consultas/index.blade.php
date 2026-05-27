@extends('layouts.app')

@section('content')

<h2 class="mb-4">

Consulta Inteligente

</h2>

<div class="card shadow p-4">

<form method="POST">

@csrf

<div class="row g-3">

    <div class="col-md-3">

        <label>Dimensión</label>

        <select name="dimension" class="form-control">

    <option
        value="Nombre"
        {{ request('dimension')=='Nombre'
            ? 'selected'
            : '' }}>

        Producto

    </option>

    <option
        value="Descripcion"
        {{ request('dimension')=='Descripcion'
            ? 'selected'
            : '' }}>

        Descripción

    </option>

</select>

    </div>

    <div class="col-md-3">

        <label>Métrica</label>

        <select
        name="metrica"
        class="form-control">

            <option
                value="ventas"
                {{ request('metrica')=='ventas'
                ? 'selected'
                : '' }}>

                Ventas Totales

            </option>

            <option
                value="ingresos"
                {{ request('metrica')=='ingresos'
                ? 'selected'
                : '' }}>

                Ingreso Total

            </option>

            <option
                value="cantidad_facturas"
                {{ request('metrica')=='cantidad_facturas'
                ? 'selected'
                : '' }}>

                Facturas

            </option>

        </select>

    </div>

    <div class="col-md-2">

        <label>Agrupar por</label>

        <select
        name="periodo"
        class="form-control">

            <option value=""
                {{ request('periodo')==''
                ? 'selected'
                : '' }}>

                Ninguno

            </option>

            <option value="dia"
                {{ request('periodo')=='dia'
                ? 'selected'
                : '' }}>

                Día

            </option>

            <option value="mes"
                {{ request('periodo')=='mes'
                ? 'selected'
                : '' }}>

                Mes

            </option>

            <option value="anio"
                {{ request('periodo')=='anio'
                ? 'selected'
                : '' }}>

                Año

            </option>

        </select>

    </div>

    <div class="col-md-2">

        <label>Orden</label>

        <select
        name="orden"
        class="form-control">

            <option value="DESC"
                {{ request('orden')=='DESC'
                ? 'selected'
                : '' }}>

                Mayor → Menor

            </option>

            <option value="ASC"
                {{ request('orden')=='ASC'
                ? 'selected'
                : '' }}>

                Menor → Mayor

            </option>

        </select>

    </div>

    <div class="col-md-2">

        <label>Top</label>

        <input
        type="number"
        name="limite"
        class="form-control"
        value="{{ request('limite',10) }}">

    </div>

    <div class="col-md-3">

        <label>Producto específico</label>

        <input
        type="text"
        name="producto"
        class="form-control"
        placeholder="Ej: AirBreeze"
        value="{{ request('producto') }}">

    </div>

    <div class="col-md-3">

        <label>Gráfica</label>

        <select
        name="grafica"
        class="form-control">

            <option value="bar"
                {{ request('grafica')=='bar'
                ? 'selected'
                : '' }}>

                Barras

            </option>

            <option value="line"
                {{ request('grafica')=='line'
                ? 'selected'
                : '' }}>

                Línea

            </option>

            <option value="pie"
                {{ request('grafica')=='pie'
                ? 'selected'
                : '' }}>

                Circular

            </option>

        </select>

    </div>

    <div class="col-md-6 d-flex align-items-end">

        <button
        class="btn btn-primary w-100">

            Generar Consulta

        </button>

    </div>

</div>

</form>

</div>

@if(isset($resultado))

<div class="chart-container mt-4">

<h4> Resultados </h4>

@if(isset($resultado) && $resultado->count())
<table class="table">

<thead>

<tr>

<th>

<th>{{ $dimension ?? 'Dimensión' }}</th>

</th>

<th> Total </th>

</tr>

</thead>

<tbody>

@foreach($resultado as $fila)

<tr>

<td>

{{ $fila->$dimension }}

</td>

<td>

{{ number_format(
$fila->total
) }}

</td>

</tr>

@endforeach

</tbody>

</table>
@endif

<canvas
id="consultaChart">
</canvas>

</div>

<script>

new Chart(

document.getElementById(
'consultaChart'
),

{

type:'{{ request('grafica','bar') }}',

data:{

labels:

@json($resultado->pluck($dimension ?? 'Nombre')),

datasets:[{

label:'Resultado',

data:

@json($resultado->pluck('total'))

}]

}

}

);

</script>

@endif

@endsection