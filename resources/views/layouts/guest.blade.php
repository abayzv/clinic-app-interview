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

<body class="font-sans text-gray-900 antialiased">
    <div class="min-h-screen flex">
        <div class="w-full lg:w-1/2 p-8 flex flex-col justify-center">
            <div class="absolute top-5 left-5">
                <x-application-logo class="h-16" />
            </div>
            <div class="max-w-md mx-auto w-full">
                <div class="space-y-8">
                    {{ $slot }}
                </div>
            </div>
        </div>

        <div class="hidden lg:block w-1/2 bg-[#860000] relative">
            <div class="absolute inset-0 flex items-center justify-center overflow-hidden">
                <img src="https://alexandra.bridestory.com/image/upload/assets/gedung-kusuma-beauty-klinik-y_RkJ_xW4.jpg"
                    class="w-full h-full object-cover opacity-20" />
            </div>
        </div>
    </div>
</body>

</html>
