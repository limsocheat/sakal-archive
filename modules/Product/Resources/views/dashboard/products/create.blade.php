<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Products') }}
        </h2>
    </x-slot>
    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <x-tailwind-form :action="route('dashboard.products.store')">
                        <div class="flex flex-col flex-nowrap">
                            <div class="w-8/12">
                                <x-form.localize-input name="name" :label="__('Name')"></x-form.localize-input>
                                <x-form-select name="type" :label="__('Type')" :options="$types">
                                </x-form-select>
                                <x-form-input name="price" :label="__('Price')">
                                </x-form-input>
                                <x-form-input name="discount" :label="__('Discount')" type="number">
                                </x-form-input>
                                <x-form-textarea name="description" :label="__('Description')" language="en">
                                </x-form-textarea>
                                <x-tailwind-form-submit />
                            </div>
                            <div class="w-4/12">


                            </div>
                        </div>
                        </x-form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
