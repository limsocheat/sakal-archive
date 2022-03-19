<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Role') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-tailwind-form :action="route('dashboard.roles.update', $role)" method="PUT">

                @bind($role)
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">Profile</h3>
                            <p class="mt-1 text-sm text-gray-600">This information will be displayed publicly so
                                be
                                careful what you share.</p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">
                        <div class="shadow sm:rounded-md sm:overflow-hidden">
                            <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                <x-form-input name="name" :label="__('Name')" />
                                <x-form-select name="guard_name" :label="__('Guard Name')" :options="$guards" />
                                <x-form-textarea name="description" :label="__('Description')" />
                                <x-tailwind-form-submit>
                                    {{ __('Save All') }}
                                </x-tailwind-form-submit>
                            </div>
                        </div>
                    </div>
                </div>

                <p>&nbsp;</p>

                <div class="mt-20 sm:mt-0">
                    <div class="md:grid md:grid-cols-3 md:gap-6">
                        <div class="md:col-span-1">
                            <div class="px-4 sm:px-0">
                                <h3 class="text-lg font-medium leading-6 text-gray-900">
                                    {{ __('Permissions') }}
                                </h3>
                                <p class="mt-1 text-sm text-gray-600">Decide which communications you'd like to
                                    receive and how.</p>
                            </div>
                        </div>

                        <div class="mt-5 md:mt-0 md:col-span-2">
                            <div class="shadow overflow-hidden sm:rounded-md">
                                <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                    @foreach ($modules as $module => $permissions)
                                        @if ($module == 'core')
                                            @forelse ($permissions as $group => $values)
                                                <h4 class="uppercase">
                                                    {{ $group }}
                                                </h4>
                                                <x-tailwind-form-group name="permission_names"
                                                    class="uppercase text-xs text-gray-600">
                                                    <div class="grid grid-cols-4">
                                                        @forelse ($values as $value)
                                                            <x-tailwind-form-checkbox name="permission_names[]"
                                                                :show-errors="false" :value="$value['name']"
                                                                :label="$value['name']" class="mt-1" />
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </x-tailwind-form-group>
                                            @empty
                                            @endforelse
                                        @elseif(\Module::find($module)->isEnabled())
                                            @forelse ($permissions as $group => $values)
                                                <h4 class="uppercase">
                                                    {{ $group }}
                                                    <small>({{ __(':module Name', ['module' => $module]) }})</small>
                                                </h4>
                                                <x-tailwind-form-group name="permission_names"
                                                    class="uppercase text-xs text-gray-600">
                                                    <div class="grid grid-cols-4">
                                                        @forelse ($values as $value)
                                                            <x-tailwind-form-checkbox name="permission_names[]"
                                                                :show-errors="false" :value="$value['name']"
                                                                :label="$value['name']" class="mt-1" />
                                                        @empty
                                                        @endforelse
                                                    </div>
                                                </x-tailwind-form-group>
                                            @empty
                                            @endforelse
                                        @endif
                                    @endforeach

                                    <x-tailwind-form-submit>
                                        {{ __('Save All') }}
                                    </x-tailwind-form-submit>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endbind
                </x-form>
        </div>
    </div>

</x-app-layout>
