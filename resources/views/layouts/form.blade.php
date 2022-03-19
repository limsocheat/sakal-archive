<x-app-layout>

    @if (isset($header))
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $header }}
            </h2>
        </x-slot>
    @endif

    <main class="max-w-7xl mx-auto sm:px-6 lg:px-8 flex flex-row flex-nowrap space-x-5">
        <div class="flex-auto">
            <div class="flex flex-col space-y-5">
                <article class="w-full">
                    {{ $slot }}
                </article>

                @if (isset($footer))
                    <footer class="bg-white shadow">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $footer }}
                        </div>
                    </footer>
                @endif
            </div>
        </div>

        @if (isset($aside))
            <aside class="w-1/4 space-y-5">
                {{ $aside }}
            </aside>
        @endif
    </main>
</x-app-layout>
