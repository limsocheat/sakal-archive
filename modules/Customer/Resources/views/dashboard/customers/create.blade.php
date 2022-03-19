<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('customer::label.create-customer') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-10 py-5">
                <x-form action="{{ route('dashboard.customers.store') }}" method="POST">
                    <x-customer::form.customer>
                        <x-slot name="password">
                            <div class="col-span-6 sm:col-span-3">
                                <x-form-input name="password" :label="__('Password')" type="password">
                                </x-form-input>
                            </div>

                            <div class="col-span-6 sm:col-span-3">
                                <x-form-input name="password_confirmation" :label="__('Password Confirmation')"
                                    type="password">
                                </x-form-input>
                            </div>
                        </x-slot>
                    </x-customer::form.customer>
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
