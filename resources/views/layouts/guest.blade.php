<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        .about-img {
            width: 150px;
            height: 150px;
        }

        .login {
            margin-top: -100px;
        }

        @media (min-width: 769px) {
            .body {
                width: 80%;
                margin-left: 175px;
                margin-right: 175px;
                margin-top: 100px;
                margin-bottom: 150px;
            }
        }

        @media (max-width: 769px) {
            .login {
                margin-top: 50px;
            }
        }
    </style>

</head>

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex flex-col sm:justify-center items-center pt-0 sm:pt-0 login">
        <div>
            <a href="/">
                <img src="{{ asset('images/MoMs-LOGO.png') }}" class="about-img"> </img>
            </a>
        </div>

        <div class="w-full sm:max-w-md mt-6 px-6 py-4 bg-white shadow-md overflow-hidden sm:rounded-lg">
            {{ $slot }}
        </div>
    </div>
</body>

</html>
