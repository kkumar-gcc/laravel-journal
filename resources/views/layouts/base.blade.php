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
            border:1px solid rgba(216, 222, 233, 1);
            border-top: none;
            max-height: 10rem;
            overflow: hidden;
            overflow-y: scroll;
        }
        .milkdown-menu{
            z-index: 100;
        }
        @media screen and (min-width: 980px) {
            .editor {
                padding: 10px 50px !important;
            }
        }
    </style>
</head>

<body class="font-sans antialiased max-w-7xl mx-auto">

    <div class="min-h-screen bg-white">
        @include('layouts.navigation')
        <!-- hiii -->
        <!-- Page Content -->
        <main class="w-full px-2 mt-2 text-gray-700 sm:px-6 sm:mt-6 md:px-20 md:mt-16 dark:text-gray-300">
            {{ $slot }}
        </main>
    </div>

    @livewireScripts
    @stack('scripts')
        <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
        <x-scripts.milkdown />
</body>

</html>
