<div>
    <div class="border-b border-gray-200 dark:border-gray-700">
        <div class="flex flex-row justify-center">
            <span class="flex-1 mt-2">{{ $label }}</span>
            <ul class="flex flex-wrap -mb-px" id="{{ $key }}-tab" data-tabs-toggle="#{{ $key }}Content"
                role="tablist">
                @foreach (config('laravellocalization.supportedLocales') as $k => $locale)
                    <li class="mr-2" role="presentation">
                        <button
                            class="inline-block py-2 px-4 text-sm font-medium text-center text-gray-500 rounded-t-lg border-b-2 border-transparent hover:text-gray-600 hover:border-gray-300 dark:text-gray-400 dark:hover:text-gray-300 {{ $k == app()->getLocale() ? 'active' : '' }}"
                            id="{{ $key }}-{{ $k }}-tab"
                            data-tabs-target="#{{ $key }}-{{ $k }}" type="button" role="tab"
                            aria-controls="{{ $key }}-{{ $k }}"
                            aria-selected="{{ $k == app()->getLocale() ? 'true' : 'false' }}">
                            {{ $locale['native'] }}
                        </button>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
    <div id="{{ $key }}-tab">

        @foreach (config('laravellocalization.supportedLocales') as $k => $locale)
            <div class="{{ $k == app()->getLocale() ? '' : 'hidden' }} rounded-lg"
                id={{ $key }}-{{ $k }} role="tabpanel" aria-labelledby="{{ $k }}-tab">
                <x-form-input :name="$name.'['.$k.']'" placeholder="{{ $locale['native'] }}"
                    value="{{ old($name, $item->translations[$name][$k] ?? null) }}">
                </x-form-input>
            </div>
        @endforeach
    </div>
</div>
