<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Código QR</title>
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
        .qr-code-container {
            border: 1px solid #dee2e6;
            background-color: #ffffff;
            padding: 15px;
            margin: 15px;
            border-radius: 5px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .qr-code-image {
            width: 300px;
            height: 300px;
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
    <div class="title">Código QR del Alumno</div>

    <!-- Código QR -->
    <div class="qr-code-container">
        <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR" class="qr-code-image">
    </div>

</body>
</html>
