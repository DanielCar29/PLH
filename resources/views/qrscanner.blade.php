<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lector de Código QR</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('/css/login/style.css')}}">
    <style>
        body { 
            font-family: Arial, sans-serif; 
            text-align: center; 
            margin: 20px; 
            background-color: #f8f9fa; 
        }
        #reader { 
            width: 100%; 
            max-width: 400px; 
            margin: auto; 
            padding: 20px; 
            background: rgba(0, 0, 0, 0.5); 
            border-radius: 10px; 
        }
        #result { 
            margin-top: 20px; 
            font-size: 18px; 
            font-weight: bold; 
            color: green; 
            background: rgba(0, 0, 0, 0.5); 
            padding: 10px; 
            border-radius: 5px; 
            color: white; 
        }
        #alumno-info { 
            margin-top: 20px; 
            font-size: 16px; 
            color: blue; 
            background: rgba(0, 0, 0, 0.5); 
            padding: 10px; 
            border-radius: 5px; 
            color: white; 
        }
        .btn { 
            background-color: #4bb4f8; 
            color: white; 
            padding: 10px 20px; 
            border: none; 
            border-radius: 5px; 
            cursor: pointer; 
        }
        .btn:hover { 
            background-color: #3a9bd9; 
        }
    </style>
</head>
<body>

    <h1>Lector de Código QR</h1>
    <div id="reader"></div>
    <p id="result">Escanea un código QR...</p>
    <button id="rescan-btn" class="btn" style="display:none;" onclick="rescan()">Volver a escanear</button>
    <button id="stop-btn" class="btn" style="display:none;" onclick="stopScanning()">Stop Scanning</button>

    <script>
        let html5QrcodeScanner;

        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('result').innerText = 'Escaneo completado';
            document.getElementById('rescan-btn').style.display = 'block';
            document.getElementById('stop-btn').style.display = 'none';
            
            html5QrcodeScanner.pause(); // Pausar en lugar de destruir

            let csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch("{{ route('register.usage') }}", {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                    'Accept': 'application/json'
                },
                body: JSON.stringify({ decodedText: decodedText })
            })
            .then(response => response.json())
            .then(data => {
                document.getElementById('result').innerText = data.message;
            })
            .catch(error => {
                console.error('Error en la solicitud:', error);
                document.getElementById('result').innerText = 'Escaneo completado';
            });
        }

        function onScanFailure(error) {
            console.warn(`Error de escaneo: ${error}`);
        }

        function rescan() {
            document.getElementById('result').innerText = 'Escanea un código QR...';
            document.getElementById('rescan-btn').style.display = 'none';
            document.getElementById('alumno-info').innerText = '';
            document.getElementById('stop-btn').style.display = 'block';

            html5QrcodeScanner.clear();
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        function stopScanning() {
            html5QrcodeScanner.clear();
            document.getElementById('result').innerText = 'Escaneo detenido';
            document.getElementById('stop-btn').style.display = 'none';
            document.getElementById('rescan-btn').style.display = 'block';
        }

        document.addEventListener("DOMContentLoaded", function() {
            html5QrcodeScanner = new Html5QrcodeScanner(
                "reader", 
                { 
                    fps: 10, 
                    qrbox: { width: 250, height: 250 },
                    supportedScanTypes: [Html5QrcodeScanType.SCAN_TYPE_CAMERA]
                },
                false
            );

            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        });
    </script>

</body>
</html>
