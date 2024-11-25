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
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen flex bg-gray-800">
            <!-- Barra lateral -->
            <aside class="w-64 bg-gray-700">
                @include('layouts.leftbar')
            </aside>

            <!-- Contenido principal -->
            <div class="flex-1 flex-col bg-gray-900">
                <!-- Barra de navegación superior -->
                @include('layouts.navigation')

                <!-- Contenido dinámico -->
                <main class="p-6 dark:bg-gray-700">
                    {{ $slot }}
                </main>

            </div>
        </div>
    </body>

</html>
