@props(['heading'])

<div class="p-4 max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700">
    <a href="#">
        <h5 class="mb-2 font-bold tracking-tight text-gray-900 dark:text-white">{{ $heading }}</h5>
    </a>

    {{ $slot }}
</div>
