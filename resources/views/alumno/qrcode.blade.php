<!DOCTYPE html>
<html>
<head>
    <title>Código QR en PDF</title>
    <style>
        /* Estilos para el contenedor del código QR */
        .qr-code-container {
            border: 2px solid #333; /* Borde sólido de 2px de grosor */
            padding: 10px; /* Espacio interior de 10px */
            display: inline-block; /* Mostrar como bloque en línea */
        }

        /* Estilos para la imagen del código QR */
        .qr-code-image {
            width: 300px; /* Ancho del código QR */
            height: 300px; /* Alto del código QR */
        }
    </style>
</head>
<body>
    <div class="qr-code-container">
        <!-- Agrega el código QR incrustado en una etiqueta <img> con la clase 'qr-code-image' -->
        <img src="data:image/png;base64,{{ $qrCodeBase64 }}" alt="Código QR" class="qr-code-image">
    </div>
</body>
</html>
