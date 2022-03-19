<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Income') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {!! Form::model($income, ['route' => ['dashboard.incomes.update', $income->uuid], 'method' => 'PUT']) !!}
            <div class="flex flex-col rounded shadow-sm">
                <div class="bg-gray-50 p-5">
                    <div class="flex flex-row flex-nowrap">
                        <div class="w-1/2">
                            Customer
                        </div>
                        <div class="w-1/2">
                            <div class="mb-2 md:mb-1 md:flex items-center">
                                <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice
                                    No.</label>
                                <span class="mr-4 inline-block md:block">:</span>
                                <div class="flex-1">
                                    <x-form-input name="code"></x-form-input>
                                </div>
                            </div>

                            <div class="mb-2 md:mb-1 md:flex items-center">
                                <label
                                    class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Invoice
                                    Date</label>
                                <span class="mr-4 inline-block md:block">:</span>
                                <div class="flex-1">
                                    <x-form-datepicker name="date" placeholder="{{ __('Select Date') }}">
                                    </x-form-datepicker>
                                </div>
                            </div>

                            <div class="mb-2 md:mb-1 md:flex items-center">
                                <label class="w-32 text-gray-800 block font-bold text-sm uppercase tracking-wide">Due
                                    date</label>
                                <span class="mr-4 inline-block md:block">:</span>
                                <div class="flex-1">
                                    <x-form-datepicker name="due_date" placeholder="{{ __('Select Date') }}">
                                    </x-form-datepicker>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="bg-white p-5">

                    <livewire:income::income-form :items="old('lines', $income->items->toArray())" />

                </div>
                <div class="bg-gray-50 p-5">
                    <x-form-textarea name="description"></x-form-textarea>
                </div>
            </div>

            <x-tailwind-form-submit></x-tailwind-form-submit>
            {!! Form::close() !!}
        </div>
    </div>
</x-app-layout>
