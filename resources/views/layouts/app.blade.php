<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {!! seo($page ?? null) !!}
    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght@100" rel="stylesheet" />
    <!-- Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>

<body class="font-sans antialiased max-w-7xl mx-auto 2xl:shadow-lg 2xl:border-x theme-teal">
    <div class="min-h-screen bg-skin-base">
        @include('layouts.navigation')
        <!-- Page Content -->
        <main>
            <div class="flex-col-reverse flex justify-between lg:flex-row">
                <div
                    class="flex-none w-full lg:w-[28%] md:min-h-[calc(100vh-81px)]  px-0 md:px-12 lg:px-8 lg:border-r lg:border-gray-200">
                    {{ $sidebar ?? '' }}
                </div>
                <div class="flex-1 w-full lg:w-[70%]">
                    {{ $slot }}
                </div>
            </div>
        </main>
    </div>
    @livewireScripts
</body>

</html>
