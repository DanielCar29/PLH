<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Notificación de Bloqueo de Beca</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }
        .container {
            width: 100%;
            max-width: 600px;
            margin: 0 auto;
            background-color: #ffffff;
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
        .header {
            background-color: #007bff;
            color: #ffffff;
            padding: 10px 0;
            text-align: center;
        }
        .content {
            margin: 20px 0;
        }
        .footer {
            text-align: center;
            color: #777777;
            font-size: 12px;
            margin-top: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Notificación de suspensión de Beca</h1>
        </div>
        <div class="content">
            <p>Estimado/a {{ $nombre }} {{ $apellidoPaterno }} {{ $apellidoMaterno }}</p>
            <p>Le informamos que su beca ha sido suspendida debido a los siguientes motivos:</p>
            <ul>
                {{ $motivo }}
            </ul>
            <p>Para más información, por favor contacte con tu supervisor en cuestión.</p>
            <p>Atentamente,</p>
            <p>El equipo de Becas</p>
        </div>
        <div class="footer">
            <p>&copy; 2025 Instituto técnologico superior de Lerdo. Todos los derechos reservados.</p>
        </div>
    </div>
</body>
</html>