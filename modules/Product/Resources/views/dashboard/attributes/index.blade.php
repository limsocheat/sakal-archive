<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Product Attributes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table.datatable>
                    <x-slot name="thead">
                        <tr>
                            <th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-search-all" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-search-all" class="sr-only">checkbox</label>
                                </div>
                            </th>
                            <x-table.th>{{ __('ID') }}</x-table.th>
                            <x-table.th>{{ __('Name') }}</x-table.th>
                            <x-table.th>{{ __('Values') }}</x-table.th>
                            <x-table.th>{{ __('Sort Order') }}</x-table.th>
                            <x-table.th class="text-right">{{ __('Action') }}</x-table.th>
                        </tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($items as $item)
                        <x-table.tr>
                            <td class="p-4 w-4">
                                <div class="flex items-center">
                                    <input id="checkbox-search-1" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-search-1" class="sr-only">checkbox</label>
                                </div>
                            </td>
                            <x-table.td>
                                {{ $item->id }}
                            </x-table.td>
                            <x-table.td>
                                {{ $item->name }}
                            </x-table.td>
                            <x-table.td>
                                <a href="{{ route('dashboard.product_attribute_values.index', $item->uuid) }}"
                                    class="text-gray-900 hover:text-white border border-gray-800 hover:bg-gray-900 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:border-gray-600 dark:text-gray-400 dark:hover:text-white dark:hover:bg-gray-600 dark:focus:ring-gray-800">
                                    {{ $item->values->count() }}
                                </a>
                            </x-table.td>
                            <x-table.td>
                                {{ $item->sort_order }}
                            </x-table.td>
                            <x-table.td class="text-right">
                                <a href="{{ route('dashboard.product_attributes.edit', $item->uuid) }}"
                                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-normal rounded-full text-sm p-2.5 text-center inline-flex items-center mr-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-3 w-3" fill="none"
                                        viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                    </svg>
                                </a>
                            </x-table.td>
                        </x-table.tr>
                        @empty
                        <x-table.tr>
                            <td colspan="100">
                                <p class="text-center items-center py-10">No products available.</p>
                            </td>
                        </x-table.tr>
                        @endforelse
                    </x-slot>
                </x-table.datatable>
            </div>
        </div>
    </div>
</x-app-layout>