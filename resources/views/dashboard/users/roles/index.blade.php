<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
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
                                <x-button.create-button href="{{ route('dashboard.roles.create') }}">
                                </x-button.create-button>
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="thead">
                        <x-table.tr>
                            <x-table.th scope="col" class="p-4">
                                <div class="flex items-center">
                                    <input id="checkbox-search-all" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-search-all" class="sr-only">checkbox</label>
                                </div>
                            </x-table.th>
                            <x-table.th width="50" class="text-center">{{ __('ID') }}</x-table.th>
                            <x-table.th>
                                {{ __('Name') }}
                            </x-table.th>
                            <x-table.th class="text-center">{{ __('Users Count') }}</x-table.th>
                            <x-table.th class="text-center">{{ __('Permissions Count') }}</x-table.th>
                            <x-table.th class="text-right">{{ __('Action') }}</x-table.th>
                        </x-table.tr>
                    </x-slot>

                    <x-slot name="tbody">
                        @forelse ($items as $item)
                        <x-table.tr>
                            <x-table.td class="p-4 w-4">
                                <div class="flex items-center">
                                    <input id="checkbox-search-1" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-search-1" class="sr-only">checkbox</label>
                                </div>
                            </x-table.td>
                            <x-table.td class="text-center">
                                {{ $item->id }}
                            </x-table.td>
                            <x-table.td>
                                {{ $item->name }}
                            </x-table.td>
                            <x-table.td class="text-center">
                                {{ $item->users()->count() }}
                            </x-table.td>
                            <x-table.td class="text-center">
                                @if ($item->is_super_admin)
                                <small>{{ __('All') }}</small>
                                @else
                                {{ $item->permissions()->count() }}
                                @endif
                            </x-table.td>
                            <x-table.td class="text-right">

                                @if ($item->is_super_admin)
                                <small class="text-xs text-gray-600 rounded-full bg-gray-400 px-2 py-1">
                                    {{ __('Super Admin') }}
                                </small>
                                @else
                                <x-button.edit-button href="{{ route('dashboard.roles.edit', $item) }}">
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