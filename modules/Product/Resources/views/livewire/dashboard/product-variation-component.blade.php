<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
        <x-table.datatable>
            <x-slot name="head">
                <div class="flex flex-row flex-nowrap justify-between">
                    <h4>{{ __('Product Variations') }}</h4>
                    <div>
                        <button type="button" data-modal-toggle="authentication-modal"
                            class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 space-x-2">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-4 w-4" fill="none"
                                viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            <span>{{ __('Add New') }}</span>
                        </button>
                    </div>
                </div>
            </x-slot>
            <x-slot name="thead">
                <x-table.tr>
                    <x-table.th>{{ __('Attribute Value') }}</x-table.th>
                    <x-table.th>{{ __('Price') }}</x-table.th>
                </x-table.tr>
            </x-slot>
            <x-slot name="tbody">
                @forelse ($variations as $variation)
                    <x-table.tr>
                        <x-table.td>{{ $variation->product_variation_names }}</x-table.td>
                        <x-table.td>{{ $variation->price }}</x-table.td>
                    </x-table.tr>
                @empty
                @endforelse
            </x-slot>
        </x-table.datatable>
    </div>

    <!-- Main modal -->
    <div id="authentication-modal" aria-hidden="true"
        class="hidden overflow-y-auto overflow-x-hidden fixed right-0 left-0 top-4 z-50 justify-center items-center h-modal md:h-full md:inset-0">
        <div class="relative px-4 w-full max-w-md h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <div class="flex justify-end p-2">
                    <button type="button"
                        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-800 dark:hover:text-white"
                        data-modal-toggle="authentication-modal">
                        <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
                            xmlns="http://www.w3.org/2000/svg">
                            <path fill-rule="evenodd"
                                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                                clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
                <x-form action="{{ route('dashboard.product_variations.store') }}" method="POST"
                    class="px-6 pb-4 space-y-6 lg:px-8 sm:pb-6 xl:pb-8">
                    <h3 class="text-xl font-medium text-gray-900 dark:text-white">
                        {{ __('Product attribute value form') }}</h3>
                    @foreach ($attributes as $attribute => $values)
                        <x-form-select name="settings[{{ $attribute }}]" :label="$attribute">
                            @foreach ($values as $value)
                                <option :value="$value->product_attribute_value_name">
                                    {{ $value->product_attribute_value_name }}</option>
                            @endforeach
                        </x-form-select>
                    @endforeach
                    <x-form-input name="price" :label="__('Price')" type="number"></x-form-input>
                    <x-form-input name="product_id" type="hidden" :value="$product->id">
                    </x-form-input>

                    <x-tailwind-form-submit></x-tailwind-form-submit>
                </x-form>
            </div>
        </div>
    </div>
</div>
