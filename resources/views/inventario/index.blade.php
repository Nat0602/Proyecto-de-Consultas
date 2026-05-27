@extends('layouts.app')

@section('content')

<h2 class="mb-4">Módulo Inventario</h2>

<div class="row">

    <div class="col-md-6">

        <div class="chart-container">

            <h5>Productos Críticos</h5>

            <table class="table">

                <tr>
                    <th>Producto</th>
                    <th>Stock</th>
                </tr>

                @foreach($criticos as $item)

                <tr>
                    <td>{{ $item->Nombre }}</td>
                    <td>{{ $item->Cantidad }}</td>
                </tr>

                @endforeach

            </table>

        </div>

    </div>

    <div class="col-md-6">

        <div class="chart-container">

            <h5>SobreStock</h5>

            <table class="table">

                <tr>
                    <th>Producto</th>
                    <th>Stock</th>
                </tr>

                @foreach($sobrestock as $item)

                <tr>
                    <td>{{ $item->Nombre }}</td>
                    <td>{{ $item->Cantidad }}</td>
                </tr>

                @endforeach

            </table>

        </div>

    </div>

</div>

@endsection