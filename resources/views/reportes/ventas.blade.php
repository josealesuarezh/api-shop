<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Document</title>
    <style>
        h1{
            text-align: center;
            text-transform: uppercase;
        }
        .contenido{
            font-size: 20px;
            display: flex;
            justify-content: center;
        }

        table, th , td{
            border: 2px solid black;
            border-collapse: collapse;
        }
    </style>
</head>
<body>
<h1>Reporte de Ventas</h1>
<hr>
<div class="contenido">
    <table>
        <thead>
            <tr>
                <th colspan="2">Gama Baja</th>
                <th colspan="2">Gama Media</th>
                <th colspan="2">Gama Alta</th>
                <th colspan="2">Total</th>
            </tr>
        </thead>
        <tr>
            <td>Total Vendido</td>
            <td>Utilidad</td>
            <td>Total Vendido</td>
            <td>Utilidad</td>
            <td>Total Vendido</td>
            <td>Utilidad</td>
            <td>Total Vendido</td>
            <td>Utilidad</td>

        </tr>
        <tr>
            <td>{{ $reporte['total_rango_bajo'] }}</td>
            <td>{{ $reporte['utilidad_rango_bajo'] }}</td>
            <td>{{ $reporte['total_rango_medio'] }}</td>
            <td>{{ $reporte['utilidad_rango_medio'] }}</td>
            <td>{{ $reporte['total_rango_alto'] }}</td>
            <td>{{ $reporte['utilidad_rango_alto'] }}</td>
            <td>{{ $reporte['total'] }}</td>
            <td>{{ $reporte['utilidad_total'] }}</td>
        </tr>
    </table>
</div>
</body>
</html>
