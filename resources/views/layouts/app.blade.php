<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Sistema OLAP</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        
        body{
            background:#f5f7fb;
        }

        .sidebar{
        width:280px;
        height:100vh;
        background:#111827;
        position:fixed;
        padding:20px;
        overflow-y:auto;
        }

        .sidebar h3{
            color:white;
            text-align:center;
        }

        .sidebar a{
            display:block;
            color:#d1d5db;
            padding:12px;
            border-radius:10px;
            text-decoration:none;
            margin-bottom:8px;
            transition:0.3s;
        }

        .sidebar a:hover{
            background:#374151;
            color:white;
        }

        .content{
        margin-left:280px;
        padding:30px;
        }

        .card-kpi{
            border:none;
            border-radius:15px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }

        .chart-container{
            background:white;
            border-radius:15px;
            padding:20px;
            box-shadow:0 2px 10px rgba(0,0,0,0.1);
        }
    </style>
</head>
<body>
    
<div class="sidebar">

    <h3 class="mb-4">VENTAS</h3>

    <!-- FILTROS -->
    <form action="/filtros" method="POST" class="mb-4">

        @csrf

        <div class="mb-3">

            <label class="form-label text-light small">
                Fecha inicio
            </label>

            <input 
                type="date"
                name="inicio"
                class="form-control form-control-sm"
                value="{{ session('inicio') }}">

        </div>

        <div class="mb-3">

            <label class="form-label text-light small">
                Fecha fin
            </label>

            <input 
                type="date"
                name="fin"
                class="form-control form-control-sm"
                value="{{ session('fin') }}">

        </div>

        <button class="btn btn-primary btn-sm w-100 mb-2">
            Aplicar
        </button>

        <a href="/filtros/limpiar" 
           class="btn btn-secondary btn-sm w-100">

            Limpiar

        </a>

    </form>

    <hr class="text-secondary">

    <!-- MENÚ -->

    <a href="/">📊 Dashboard Ejecutivo</a>

    <a href="/ventas">
    💰 Ventas & Rentabilidad
    </a>

    <a href="/inventario">
    📦 Inventario Estratégico
    </a>

    <a href="/precios">
    💲 Evolución de Precios
    </a>

    <a href="/facturacion">
    🧾 Facturación & Clientes
    </a>

    <a href="/consultas">
    🔎 Consulta Inteligente
    </a>

</div>
<div class="content">

    @yield('content')

</div>
</body>
</html>