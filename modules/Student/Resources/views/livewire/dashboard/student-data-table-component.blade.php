<div>

    <x-table.datatable>
        <x-slot name="head">

            <div class="flex flex-row justify-between">
                <div>
                    <x-form-input :placeholder="__('Name')" name="search" wire:model.debounce.350ms="search">
                    </x-form-input>
                </div>
                <div>
                    @can('create students')
                        <x-button.excel-button wire:click="exportExcel">
                        </x-button.excel-button>
                    @endcan

                    @can('create students')
                        <x-button.create-button href="{{ route('dashboard.students.create') }}">
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
                <x-table.th>{{ __('First Name') }}</x-table.th>
                <x-table.th>{{ __('Last Name') }}</x-table.th>
                <x-table.th>{{ __('Gender') }}</x-table.th>
                <x-table.th>{{ __('Date of Birth') }}</x-table.th>
                <x-table.th>{{ __('Nationality') }}</x-table.th>
                <x-table.th>{{ __('Phone') }}</x-table.th>
                <x-table.th>{{ __('Print') }}</x-table.th>
                <x-table.th class="text-right">{{ __('Action') }}</x-table.th>
            </x-table.tr>
        </x-slot>

        <x-slot name="tbody">
            @forelse ($students as $student)
                <x-table.tr>
                    <x-table.td class="p-4 w-4">
                        <div class="flex items-center">
                            <input id="checkbox-search-1" type="checkbox"
                                class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                            <label for="checkbox-search-1" class="sr-only">checkbox</label>
                        </div>
                    </x-table.td>
                    <x-table.td>
                        {{ $student->id }}
                    </x-table.td>
                    <x-table.td>
                        {{ $student->first_name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $student->last_name }}
                    </x-table.td>
                    <x-table.td>
                        {{ $student->gender }}
                    </x-table.td>
                    <x-table.td>
                        {{ $student->date_of_birth }}
                    </x-table.td>
                    <x-table.td>
                        {{ $student->nationality }}
                    </x-table.td>
                    <x-table.td>
                        {{ $student->phone }}
                    </x-table.td>
                    <x-table.td>
                        <x-button.print-button href="{{ route('dashboard.print.student', $student) }}">
                        </x-button.print-button>
                    </x-table.td>
                    <x-table.td class="text-right">
                        <x-button.edit-button href="{{ route('dashboard.students.edit', $student) }}">
                        </x-button.edit-button>
                        <x-button.delete-button :action="route('dashboard.students.destroy',$student)"
                            :method="'DELETE'" :class="'red'" :icon="'times'" :title="__('Delete Student')"
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
        {{ $students->links('pagination-links') }}
    </div>

</div>
