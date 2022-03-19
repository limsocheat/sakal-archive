<div>
    <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-5">
        <x-table.datatable>
            <x-slot name="head">
                <h4>{{ __('Product Attribute Value Items') }}</h4>
            </x-slot>
            <x-slot name="thead">
                <x-table.tr>
                    <x-table.th>{{ __('Image') }}</x-table.th>
                    <x-table.th>{{ __('Attribute') }}</x-table.th>
                    <x-table.th>{{ __('Value') }}</x-table.th>
                    <x-table.th class="text-right">{{ __('Actions') }}</x-table.th>
                </x-table.tr>
            </x-slot>
            <x-slot name="tbody">
                @forelse ($attribute_value_items as $attribute_value_item)
                    <x-table.tr>
                        <x-table.td>
                            <img src="{{ $attribute_value_item->image_url }}" :alt="$attribute_value_item->name"
                                class="w-8 h-8 rounded-full" />
                        </x-table.td>
                        <x-table.td>{{ $attribute_value_item->product_attribute_name }}</x-table.td>
                        <x-table.td>{{ $attribute_value_item->product_attribute_value_name }}</x-table.td>
                        <x-table.td class="text-right cursor-pointer">
                            <x-button.edit-button wire:click="setItem({{ $attribute_value_item }})"
                                data-modal-toggle="authentication-modal"></x-button.edit-button>
                        </x-table.td>
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

                    @bind($item)
                    <x-form-input name="price" :label="__('Price')" type="number"></x-form-input>
                    <x-form-input name="product_id" type="hidden" :value="$product->id">
                    </x-form-input>
                    @endbind

                    <x-tailwind-form-submit></x-tailwind-form-submit>
                </x-form>
            </div>
        </div>
    </div>
</div>
