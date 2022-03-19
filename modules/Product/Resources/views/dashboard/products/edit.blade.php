<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Products') }}
        </h2>
    </x-slot>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 space-y-10">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <div class="p-6 sm:px-20 bg-white border-b border-gray-200">
                    <x-tailwind-form :action="route('dashboard.products.update', $item->uuid)" method="PUT">
                        @bind($item)
                        <div class="flex flex-row flex-nowrap space-x-10">
                            <div class="w-8/12">
                                <x-form.localize-input name="name" :label="__('Name')" :key="'name'">
                                </x-form.localize-input>
                                <x-form-localized-text-editor name="description" :label="__('Description')"
                                    :key="'description'">
                                </x-form-localized-text-editor>

                                <x-form-select name="type" :label="__('Type')" :options="$types">
                                </x-form-select>
                                <x-tailwind-form-group inline>
                                    <x-form-input name="price" :label="__('Price')">
                                    </x-form-input>
                                    <x-form-input name="discount" :label="__('Discount')" type="number">
                                    </x-form-input>
                                </x-tailwind-form-group>
                                <x-tailwind-form-submit />
                            </div>
                            <div class="w-4/12 space-y-5">

                                <x-sakal.card>
                                    <x-slot name="heading" class="font-bold">
                                        {{ __('Product Categories') }}
                                    </x-slot>
                                    <x-form-select name="product_category_ids" :label="__('Product Category')"
                                        :options="$categories"></x-form-select>
                                </x-sakal.card>

                                <x-form-featured-image :label="__('Product Featured Image')" name="featured_image_id"
                                    :id="$item->featured_image_id"
                                    featured_image_url="{{ $item->featured_image_url }}">
                                </x-form-featured-image>
                            </div>
                        </div>
                        @endbind
                        </x-form>

                </div>
            </div>

            <livewire:product::dashboard.product-attribute-item-value-component :product="$item" />
            <livewire:product::dashboard.product-variation-component :product="$item" />

            <div class="h-10">&nbsp;</div>
        </div>
    </div>


</x-app-layout>
