<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Incomes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <x-table.datatable>

                    <x-slot name="head">
                        <div class="flex flex-row justify-between">
                            <div></div>
                            <div>
                                @can('create incomes')
                                    <x-button.create-button href="{{ route('dashboard.incomes.create') }}">
                                    </x-button.create-button>
                                @endcan
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="thead">
                        <x-table.tr>
                            <x-table.th scope="col" class="p-4" width="50">
                                <div class="flex items-center">
                                    <input id="checkbox-search-all" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-search-all" class="sr-only">checkbox</label>
                                </div>
                            </x-table.th>
                            <x-table.th width="50">{{ __('Code') }}</x-table.th>
                            <x-table.th>{{ __('Date') }}</x-table.th>
                            <x-table.th>{{ __('Billable') }}</x-table.th>
                            <x-table.th>{{ __('Total') }}</x-table.th>
                            <x-table.th>{{ __('Tags') }}</x-table.th>
                            <x-table.th>{{ __('Status') }}</x-table.th>
                            <x-table.th class="text-right">{{ __('Action') }}</x-table.th>
                        </x-table.tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($incomes as $income)
                            <x-table.tr>
                                <x-table.td class="p-4 w-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-search-1" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </x-table.td>
                                <x-table.td>
                                    {{ $income->code }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $income->date }}
                                </x-table.td>
                                <x-table.td>
                                    {{ $income->incomeable->name }}
                                </x-table.td>
                                <x-table.td>
                                    @money($income->total)
                                </x-table.td>
                                <x-table.td>
                                </x-table.td>
                                <x-table.td>
                                    {{ $income->status }}
                                </x-table.td>
                                <x-table.td class="text-right">
                                    @if ($income->is_super_admin)
                                        <small class="text-xs text-gray-600 rounded-full bg-gray-400 px-2 py-1">
                                            {{ __('Super Admin') }}
                                        </small>
                                    @else
                                        <x-button.edit-button href="{{ route('dashboard.incomes.edit', $income) }}">
                                        </x-button.edit-button>
                                    @endif
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
