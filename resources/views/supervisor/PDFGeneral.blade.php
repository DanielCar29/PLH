<!DOCTYPE html>
<html>
<head>
    <title>Reporte de Alumnos</title>
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
        .info {
            border: 1px solid #dee2e6;
            background-color: #ffffff;
            padding: 15px;
            margin: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }
        .info .field {
            margin: 10px 0;
            font-size: 1rem;
        }
        .info .field strong {
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
    <div class="header">
        <div class="institution">Instituto Tecnológico Superior de Lerdo</div>
        <div class="logo">
            <img src="{{ public_path('img/logo_oficial_tec_lerdo_nov2017_transparente.png') }}" alt="Logo ITSL">
        </div>
    </div>

    <div class="title">Reporte de Alumnos</div>

    @foreach($alumnos as $alumno)
        <div class="info">
            <div class="field"><strong>Nombre:</strong> {{ $alumno->nombre }} {{ $alumno->apellido_paterno }} {{ $alumno->apellido_materno }}</div>
            <div class="field"><strong>Número de Control:</strong> {{ $alumno->numero_de_control }}</div>
            <div class="field"><strong>Carrera:</strong> {{ $alumno->carrera }}</div>
            <div class="field"><strong>Veces Uso Beca:</strong> {{ $alumno->veces_uso_beca }}</div>
            <table>
                <thead>
                    <tr>
                        <th>Mes</th>
                        <th>Veces Uso Beca</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($reportesPorMes[$alumno->alumno_id] as $reporte)
                        <tr>
                            <td>{{ $reporte->mes }}</td>
                            <td>{{ $reporte->veces_uso_beca }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endforeach
</body>
</html>
