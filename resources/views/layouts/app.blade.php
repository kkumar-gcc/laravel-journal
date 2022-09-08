<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased max-w-7xl mx-auto">
    <div class="min-h-screen bg-white">
        @include('layouts.navigation')
        <!-- Page Content -->
        <main>
            <div class="flex-col-reverse flex justify-between lg:flex-row">
                <div class="flex-none w-full lg:w-[28%]  px-0 md:px-12 lg:px-8 lg:border-r lg:border-gray-200">
                   {{ $sidebar ?? '' }}
                </div>
                <div class="flex-1 w-full lg:w-[70%]">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
    @livewireScripts
    <script src="https://cdn.jsdelivr.net/gh/livewire/turbolinks@v0.1.x/dist/livewire-turbolinks.js" data-turbolinks-eval="false" data-turbo-eval="false"></script>
</body>

</html>
