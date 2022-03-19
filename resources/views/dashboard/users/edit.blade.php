<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit User') }}
        </h2>
    </x-slot>

    <div class="py-6">
        {!! Form::model($user, ['route' => ['dashboard.users.update', $user], 'method' => 'PUT']) !!}
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <x-form.user-form :roles="$roles"></x-form.user-form>

                    <p>&nbsp;</p>

                    <div class="mt-20 sm:mt-0">
                        <div class="md:grid md:grid-cols-3 md:gap-6">
                            <div class="md:col-span-1">
                                <div class="px-4 sm:px-0">
                                    <h3 class="text-lg font-medium leading-6 text-gray-900">{{ __('Permissions') }}
                                    </h3>
                                    <p class="mt-1 text-sm text-gray-600">Decide which communications you'd like to
                                        receive and how.</p>
                                </div>
                            </div>

                            <div class="mt-5 md:mt-0 md:col-span-2">
                                <div class="shadow overflow-hidden sm:rounded-md">
                                    <div class="px-4 py-5 bg-white space-y-6 sm:p-6">
                                        @forelse ($permissions as $group => $values)
                                            <h4 class="uppercase">{{ $group }}</h4>
                                            <div class="grid grid-cols-4">
                                                @forelse ($values as $value)
                                                    <x-form-checkbox name="permission_names[]" :show-errors="false"
                                                        :value="$value['name']" :label="$value['name']"
                                                        class="mt-1" />
                                                @empty
                                                @endforelse
                                            </div>
                                        @empty

                                        @endforelse

                                        <x-form-submit>
                                            {{ __('Save All') }}
                                        </x-form-submit>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        {!! Form::close() !!}
    </div>

</x-app-layout>
