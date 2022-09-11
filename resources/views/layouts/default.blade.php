<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles

    <style>
        .milkdown-menu-wrapper {}

        .milkdown {
            box-shadow: none !important;
        }
        .milkdown-menu{
            z-index: 100;
        }
        @media screen and (min-width: 980px) {
            .editor {
                padding: 50px 50px !important;
            }
        }
    </style>
</head>

<body class="font-sans antialiased max-w-7xl mx-auto">
    <div class="min-h-screen bg-white">
        <!-- Page Content -->
        <main class="w-full">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js"
        data-turbolinks-eval="false" data-turbo-eval="false"></script>
    @stack('scripts')
</body>

</html>
