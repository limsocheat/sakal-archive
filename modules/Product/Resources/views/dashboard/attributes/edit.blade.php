<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Product Attributes') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <x-tailwind-form :action="route('dashboard.product_attributes.update', $item->uuid)" method="PUT">
                        @bind($item)
                        <x-form.localize-input name="name" :label="__('Name')"></x-form.localize-input>
                        <x-form-select name="type" :label="__('Type')" :options="$types">
                        </x-form-select>
                        <x-tailwind-form-submit></x-tailwind-form-submit>
                        @endbind
                        </x-form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
