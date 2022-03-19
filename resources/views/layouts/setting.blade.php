<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Settings') }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-5">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">

            {!! Menu::render($menu) !!}

        </div>

        {{ $slot }}
    </div>
</x-app-layout>
