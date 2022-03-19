<div class="space-y-5">
    @foreach ($attributes as $attribute => $values)
        <div key="{{ $attribute }}">
            <h3 class="text-sm text-gray-900 font-bold pb-1">{{ $attribute }}</h3>
            <fieldset>
                <legend class="sr-only"></legend>
                <div class="flex items-center space-x-3">
                    @foreach ($values as $value)
                        <div key="{{ $value->product_attribute_value_name }}">
                            <label
                                class="group relative border rounded-md px-4 flex items-center justify-center text-sm font-medium uppercase hover:bg-gray-50 focus:outline-none sm:flex-1 sm:py-2 bg-white shadow-sm text-gray-900 cursor-pointer">
                                <input type="radio" name="settings[{{ $attribute }}]"
                                    wire:model="settings.{{ $attribute }}"
                                    value="{{ $value->product_attribute_value_name }}" class="sr-only"
                                    aria-labelledby="size-choice-4-label" />
                                @if ($value->settings()->has('image_url'))
                                    <img src="{{ $value->settings()->get('image_url') }}"
                                        alt="{{ $value->product_attribute_value_name }}" class="h-8 w-8 rounded-full">
                                @else
                                    <p id="size-choice-4-label">{{ $value->product_attribute_value_name }}</p>
                                @endif

                                <div class="{{ $settings[$attribute] == $value->product_attribute_value_name? 'border border-indigo-500': 'border-2 border-transparent' }} absolute -inset-px rounded-md pointer-events-none"
                                    aria-hidden="true">
                                </div>
                            </label>
                        </div>
                    @endforeach
                </div>
            </fieldset>
        </div>
    @endforeach

    @if ($variation)
        <p class="text-3xl text-gray-900">${{ $variation->price }}</p>
    @endif

    <div>
        @if ($message)
            <small class="text-red-500">{{ $message }}</small>
        @endif
        <button type="submit" {{ !$variation ? 'disabled' : '' }}
            class="w-full bg-indigo-600 disabled:bg-gray-400 border border-transparent rounded-md py-3 px-8 flex items-center justify-center text-base font-medium text-white hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">Add
            to bag</button>
    </div>
</div>
