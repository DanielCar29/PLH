<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lector de Código QR</title>
    <script src="https://unpkg.com/html5-qrcode"></script>
    <link rel="shortcut icon" href="{{URL::asset('/img/favicon.ico')}}" type="image/x-icon">
    <link rel="stylesheet" href="{{ asset('/css/login/style.css')}}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- CDN de Boostrap CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" 
    rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" 
    crossorigin="anonymous">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('/img/fondo-login-blanco.jpg');
            margin: 0;
            padding: 40px 20px;
            color: #fff;
        }

        h1 {
            background: linear-gradient(135deg, #3498db, #2ecc71);
            color: white;
            padding: 25px 35px;
            border-radius: 16px;
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.25);
            font-size: 2.8rem;
            font-weight: 700;
            max-width: 800px;
            margin: 0 auto 40px auto;
            text-align: center;
            letter-spacing: 1.2px;
        }

        .glass-container {
            max-width: 1000px;
            margin: auto;
            padding: 30px;
            background: rgba(255, 255, 255, 0.08);
            border-radius: 20px;
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            box-shadow: 0 8px 24px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .flex-container {
            display: flex;
            justify-content: space-between;
            gap: 30px;
            flex-wrap: wrap;
        }

        .left-pane, .right-pane {
            flex: 1;
            min-width: 300px;
        }

        #reader {
            width: 100%;
            background: rgba(0, 0, 0, 0.5);
            padding: 20px;
            border-radius: 10px;
        }

        .right-pane {
            display: flex;
            flex-direction: column;
            justify-content: center;
        }

        #result, #alumno-info {
            margin-top: 15px;
            font-size: 18px;
            font-weight: bold;
            background: rgba(0, 0, 0, 0.5);
            padding: 10px;
            border-radius: 5px;
            color: white;
        }

        .center-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            flex-wrap: wrap;
            margin-top: 20px;
        }

        .btn {
            background-color: #4bb4f8;
            color: white;
            padding: 12px 24px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 16px;
        }

        .btn:hover {
            background-color: #3a9bd9;
        }

        .hidden {
            display: none;
        }

        .logout-container {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .logout-container .btn {
            padding: 15px 25px;
            font-size: 16px;
            background-color: red;
            transition: background-color 0.3s;
            font-size: 1.2rem;
        }

        .logout-container .btn:hover {
            background-color: #b30000;
        }
    </style>
</head>
<body>

    <div class="logout-container">
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="btn">Salir</button>
        </form>
    </div>

    <h1>Lector de Código QR</h1>

    <div class="glass-container flex-container">
        <!-- Escáner QR -->
        <div class="left-pane">
            <div id="reader"></div>
        </div>

        <!-- Resultados y botones -->
        <div class="right-pane">
            <p id="result">Escanea un código QR...</p>
            <p id="alumno-info"></p>

            <div class="center-buttons">
                <button id="rescan-btn" class="btn hidden" onclick="rescan()">Volver a escanear</button>
                <button id="stop-btn" class="btn" onclick="stopScanning()">Detener escaneo</button>
            </div>
        </div>
    </div>

    <script>
        let html5QrcodeScanner;

        function onScanSuccess(decodedText, decodedResult) {
            document.getElementById('result').innerText = 'Escaneo completado';
            document.getElementById('rescan-btn').classList.remove('hidden');
            document.getElementById('stop-btn').classList.add('hidden');

            html5QrcodeScanner.pause();

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
            document.getElementById('alumno-info').innerText = '';
            document.getElementById('rescan-btn').classList.add('hidden');
            document.getElementById('stop-btn').classList.remove('hidden');

            html5QrcodeScanner.clear();
            html5QrcodeScanner.render(onScanSuccess, onScanFailure);
        }

        function stopScanning() {
            html5QrcodeScanner.clear();
            document.getElementById('result').innerText = 'Escaneo detenido';
            document.getElementById('stop-btn').classList.add('hidden');
            document.getElementById('rescan-btn').classList.remove('hidden');
        }

        document.addEventListener("DOMContentLoaded", function () {
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
