<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Reporte Alumno - {{ $alumno->numero_de_control }}</title>
    
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f8f9fa;
        }
        .header {
            padding: 20px;
            background-color: #343a40;
            color: #ffffff;
        }
        .header .institution {
            font-size: 1.5rem;
            font-weight: bold;
            color: #ffffff;
            display: inline-block;
            vertical-align: middle;
        }
        .header .logo {
            display: inline-block;
            vertical-align: middle;
            margin-left: 20px;
        }
        .header .logo img {
            max-height: 60px;
        }
        .title {
            text-align: center;
            margin: 20px 0;
            font-size: 1.5rem;
            font-weight: bold;
            color: #495057;
        }
        .info, .reports {
            border: 1px solid #dee2e6;
            background-color: #ffffff;
            padding: 15px;
            margin: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .info .field, .reports .field {
            margin: 10px 0;
            font-size: 1rem;
        }
        .info .field strong, .reports .field strong {
            color: #343a40;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        th {
            background-color: #f8f9fa;
            text-align: left;
            padding: 8px;
        }
        td {
            padding: 8px;
            text-align: left;
        }
        table, th, td {
            border: 1px solid #dee2e6;
        }
    </style>
</head>
<body>

    <!-- Encabezado -->
    <div class="header">
        <div class="institution">Instituto Tecnológico Superior de Lerdo</div>
        <div class="logo">
            <img src="{{ public_path('img/logo_oficial_tec_lerdo_nov2017_transparente.png') }}" alt="Logo ITSL">
        </div>
    </div>
    
    <!-- Título del Documento -->
    <div class="title">Reporte del Alumno</div>
    
    <!-- Información del Alumno -->
    <div class="info">
        <div class="field"><strong>Número de Control:</strong> {{ $alumno->numero_de_control }}</div>
        <div class="field"><strong>Nombre:</strong> {{ $alumno->nombre }}</div>
        <div class="field"><strong>Apellido Paterno:</strong> {{ $alumno->apellido_paterno }}</div>
        <div class="field"><strong>Apellido Materno:</strong> {{ $alumno->apellido_materno }}</div>
        <div class="field"><strong>Carrera:</strong> {{ $alumno->carrera }}</div>
    </div>

    <!-- Reportes de Uso agrupados por mes -->
    <div class="reports">
        <strong>Reportes de Uso:</strong>
        @foreach ($reportesPorMes as $mes => $reportesDelMes)
            <h3>{{ $mes }}</h3> <!-- Muestra el mes -->
            <table>
                <thead>
                    <tr>
                        <th>Fecha de Uso de Beca</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reportesDelMes as $reporte)
                        <tr>
                            <td>{{ $reporte->fecha_uso_beca }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endforeach
    </div>

</body>
</html>
