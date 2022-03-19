<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modules') }}
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
                                @can('create users')
                                    <x-button.create-button href="{{ route('dashboard.users.create') }}">
                                    </x-button.create-button>
                                @endcan
                            </div>
                        </div>
                    </x-slot>

                    <x-slot name="thead">
                        <x-table.tr>
                            <x-table.th scope="col" class="p-4" width="30">
                                <div class="flex items-center">
                                    <input id="checkbox-search-all" type="checkbox"
                                        class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                    <label for="checkbox-search-all" class="sr-only">checkbox</label>
                                </div>
                            </x-table.th>
                            <x-table.th width="80">{{ __('Image') }}</x-table.th>
                            <x-table.th width="150">{{ __('Name') }}</x-table.th>
                            <x-table.th>{{ __('Description') }}</x-table.th>
                            <x-table.th width="200">{{ __('Required Modules') }}</x-table.th>
                            <x-table.th width="50">{{ __('Status') }}</x-table.th>
                            <x-table.th width="50" class="text-right">{{ __('Action') }}</x-table.th>
                        </x-table.tr>
                    </x-slot>
                    <x-slot name="tbody">
                        @forelse ($modules as $module)
                            <x-table.tr>
                                <x-table.td class="p-4 w-4">
                                    <div class="flex items-center">
                                        <input id="checkbox-search-1" type="checkbox"
                                            class="w-4 h-4 text-blue-600 bg-gray-100 rounded border-gray-300 focus:ring-blue-500 dark:focus:ring-blue-600 dark:ring-offset-gray-800 focus:ring-2 dark:bg-gray-700 dark:border-gray-600">
                                        <label for="checkbox-search-1" class="sr-only">checkbox</label>
                                    </div>
                                </x-table.td>
                                <x-table.td>
                                    <img src="{{ Module::asset($module->getLowerName() . ':images/icon.png') }}" />
                                </x-table.td>
                                <x-table.td>
                                    {{ $module->getName() }} <br>
                                    <small class="text-xs text-gray-500">
                                        Version: {{ config($module->getLowerName() . '.version') }}
                                    </small>
                                </x-table.td>
                                <x-table.td class="text-sm font-normal">
                                    {{ config($module->getLowerName() . '.description') }}
                                    <br>
                                    <small class="text-xs text-gray-500">
                                        By: {{ config($module->getLowerName() . '.author') }}
                                    </small>
                                </x-table.td>
                                <x-table.td class="space-2">
                                    @foreach ($module->getRequires() as $requiredModule)
                                        <span
                                            class="bg-blue-100 text-blue-800 text-xs font-semibold mr-2 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                                            {{ $requiredModule }}
                                        </span>
                                    @endforeach
                                </x-table.td>
                                <x-table.td>
                                    @if ($module->isEnabled())
                                        <span
                                            class="px-2 py-1 text-xs text-green-600 bg-green-100 border border-green-200 rounded-full">
                                            {{ __('Active') }}
                                        </span>
                                    @else
                                        <span
                                            class="px-2 py-1 text-xs text-red-600 bg-red-100 border border-red-200 rounded-full">
                                            {{ __('Inactive') }}
                                        </span>
                                    @endif
                                </x-table.td>
                                <x-table.td class="text-right">
                                    @if ($module->isEnabled())
                                        <x-button.action-button
                                            :action="route('dashboard.modules.disable', $module->getLowerName())"
                                            :method="'POST'" :class="'red'" :icon="'times'"
                                            :title="__('Disable')"
                                            :confirm="__('Are you sure you want to disable this module?')"
                                            :id="$module->getLowerName()">
                                        </x-button.action-button>
                                    @else
                                        <x-button.action-button
                                            :action="route('dashboard.modules.enable', $module->getLowerName())"
                                            :method="'POST'" :class="'green'" :icon="'check'"
                                            :title="__('Enable')"
                                            :confirm="__('Are you sure you want to enable this module?')"
                                            :id="$module->getLowerName()">
                                        </x-button.action-button>
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
