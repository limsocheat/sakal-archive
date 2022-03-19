<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    @googlefonts

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link rel="stylesheet" href="https://unpkg.com/flowbite@1.3.4/dist/flowbite.min.css" />

    @livewireStyles

    @stack('styles')

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

</head>

<body class="bg-gray-100">

    <div class="flex">
        <div class="h-screen sticky top-0 w-64 ">
            @livewire('dashboard.layout.drawer')
        </div>
        <div class="w-full flex flex-col ">

            <x-jet-banner />

            @livewire('dashboard.layout.app-bar')
            <i class="fi fi-rr-home"></i>
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main class="space-y-6">
                <x-sakal.alert />
                {{ $slot }}
            </main>
        </div>
    </div>

    @stack('modals')

    @livewireScripts
    <script src="https://unpkg.com/flowbite@1.3.3/dist/flowbite.js"></script>
    <script src="https://cdn.jsdelivr.net/gh/livewire/sortable@v0.x.x/dist/livewire-sortable.js"></script>
    @stack('scripts')
</body>

</html>
