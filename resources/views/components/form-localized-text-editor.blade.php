<div>
    <div class="border-b border-gray-200 dark:border-gray-700 mb-2">
        <div class="flex flex-row justify-center">
            <span class="flex-1 mt-2">{{ $label }}</span>
            <ul class="flex flex-wrap -mb-px" id="{{ $key }}-tab" data-tabs-toggle="#{{ $key }}"
                role="tablist">
                @foreach (config('laravellocalization.supportedLocales') as $k => $locale)
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-block py-2 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 {{ $k == app()->getLocale() ? 'active' : '' }}"
                            id="{{ $key }}-{{ $k }}-tab"
                            data-tabs-target="#{{ $key }}-{{ $k }}" type="button" role="tab"
                            aria-controls={{ $key }}-{{ $k }}
                            aria-selected="{{ $k == app()->getLocale() ? 'true' : 'false' }}">
                            {{ $locale['native'] }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div id="{{ $key }}">
        @foreach (config('laravellocalization.supportedLocales') as $k => $locale)
            <div class="{{ $k == app()->getLocale() ? '' : 'hidden' }} rounded-lg"
                id={{ $key }}-{{ $k }} role="tabpanel"
                aria-labelledby="{{ $key }}-{{ $k }}-tab">
                <x-form-input type="hidden" :name="$name" :language="$k"
                    id="{{ $name }}[{{ $k }}]">
                </x-form-input>
                <trix-editor
                    class="block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                    input="{{ $name }}[{{ $k }}]" style="min-height: {{ $height }}"
                    placeholder="{{ $locale['native'] }}">
                </trix-editor>
            </div>
        @endforeach
    </div>
</div>

@push('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/trix/1.3.1/trix.css" type="text/css" />
@endpush

@push('scripts')
    <script src="https://unpkg.com/trix@2.0.0-alpha.0/dist/trix.umd.js"></script>
@endpush
