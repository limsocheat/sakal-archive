<div>

    <x-table.datatable>
        <x-slot name="head">

            <div class="flex flex-row justify-between">
                <div>
                    <x-form-input :placeholder="__('Name')" name="search" wire:model.debounce.350ms="search">
                    </x-form-input>
                </div>
                <div>
                    @can('create majors')
                        <x-button.excel-button wire:click="exportExcel">
                        </x-button.excel-button>
                    @endcan

                    @can('create majors')
                        <x-button.create-button href="{{ route('dashboard.majors.create') }}">
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
                <x-table.th width="50" sortable>{{ __('ID') }}</x-table.th>

                <x-table.th>{{ __('Name') }}</x-table.th>
                <x-table.th>{{ __('Description') }}</x-table.th>
                <x-table.th class="text-right">{{ __('Action') }}</x-table.th>
            </x-table.tr>
        </x-slot>

        <x-slot name="tbody">
            @forelse ($majors as $major)
                <x-table.tr>
                    <x-table.td class="p-4 w-4">
                        <div class="flex items-center">
                            <input id="checkbox-search-1" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-search-1" class="sr-only">checkbox</label>
                        </div>
                    </x-table.td>
                    <x-table.td>
                        {{ $major->id }}
                    </x-table.td>
                    <x-table.td>
                        {{ $major->name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $major->description }}
                    </x-table.td>
                    <x-table.td class="text-right">
                        <x-button.edit-button href="{{ route('dashboard.majors.edit', $major) }}">
                        </x-button.edit-button>
                        <x-button.delete-button :action="route('dashboard.majors.destroy',$major)" :method="'DELETE'"
                            :class="'red'" :icon="'times'" :title="__('Delete Major')"
                            :confirm="__('Are you sure you want to delete?')">
                        </x-button.delete-button>
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
    <div class="py-5 px-2">
        {{ $majors->links('pagination-links') }}
    </div>

</div>
