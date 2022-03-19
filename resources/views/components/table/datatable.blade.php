@props(['head', 'thead', 'tbody'])

<div>

    <div class="flex flex-col">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <div class="inline-block min-w-full align-middle dark:bg-gray-800">
                @if (isset($head))
                    <div class="p-4">
                        {{ $head }}
                    </div>
                @endif
                <div class="overflow-hidden">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                        @if (isset($thead))
                            <thead class="bg-gray-100 dark:bg-gray-700">
                                {{ $thead }}
                            </thead>
                        @endif
                        @if (isset($tbody))
                            <tbody class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                                {{ $tbody }}
                            </tbody>
                        @endif
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
