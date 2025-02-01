<html>
    <head>
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
            .action-button {
                display: inline-block;
                padding: 10px 20px;
                background-color: #007bff;
                color: #ffffff;
                text-align: center;
                text-decoration: none;
                border-radius: 5px;
                margin: 20px 0;
            }
            .action-button:hover {
                background-color: #0056b3;
            }
        </style>
    </head>
    <body>
        <div class="container">
            <div class="header">
                <h1>Aviso Importante</h1>
            </div>
            <div class="content">
                {{-- Greeting --}}
                @if (! empty($greeting))
                    <h2>{{ $greeting }}</h2>
                @else
                    @if ($level === 'error')
                        <h2>@lang('Whoops!')</h2>
                    @else
                        <h2>@lang('Hello!')</h2>
                    @endif
                @endif

                {{-- Intro Lines --}}
                @foreach ($introLines as $line)
                    <p>{{ $line }}</p>
                @endforeach

                {{-- Action Button --}}
                @isset($actionText)
                    <a href="{{ $actionUrl }}" class="action-button">{{ $actionText }}</a>
                @endisset

                {{-- Outro Lines --}}
                @foreach ($outroLines as $line)
                    <p>{{ $line }}</p>
                @endforeach

                {{-- Salutation --}}
                @if (! empty($salutation))
                    <p>{{ $salutation }}</p>
                @else
                    <p>@lang('Regards'),<br>{{ config('app.name') }}</p>
                @endif

                {{-- Subcopy --}}
                @isset($actionText)
                    <div style="font-size: 12px; color: #777777;">
                        @lang(
                            "If you're having trouble clicking the \":actionText\" button, copy and paste the URL below\n".
                            'into your web browser:',
                            [
                                'actionText' => $actionText,
                            ]
                        ) 
                        <br>
                        <a href="{{ $actionUrl }}" style="color: #007bff;">{{ $actionUrl }}</a>
                    </div>
                @endisset
            </div>
            <div class="footer">
                <p>&copy; {{ date('Y') }} {{ config('app.name') }}. Todos los derechos reservados.</p>
            </div>
        </div>
    </body>
</html>
