<div>
    <div class="flex flex-col">
        <div class="overflow-x-auto shadow-md sm:rounded-lg">
            <div class="initem-block min-w-full align-middle">
                <div class="overflow-hidden ">
                    <table class="min-w-full divide-y divide-gray-200 table-fixed dark:divide-gray-700">
                        <thead class="bg-gray-100 dark:bg-gray-700">
                            <tr>
                                <x-table.th style="width: 40px">
                                    {{ __('Order') }}
                                </x-table.th>
                                <x-table.th>
                                    {{ __('Item') }}
                                </x-table.th>
                                <x-table.th>
                                    {{ __('Description') }}
                                </x-table.th>
                                <x-table.th>
                                    {{ __('Quantity') }}
                                </x-table.th>
                                <x-table.th>
                                    {{ __('Price') }}
                                </x-table.th>
                                <x-table.th>
                                    {{ __('Subtotal') }}
                                </x-table.th>
                                <x-table.th>
                                    {{ __('Action') }}
                                </x-table.th>
                            </tr>
                        </thead>
                        <tbody wire:sortable="reorderItems"
                            class="bg-white divide-y divide-gray-200 dark:bg-gray-800 dark:divide-gray-700">
                            @foreach ($items as $key => $item)
                                <x-table.tr wire:sortable.item="{{ $key }}"
                                    wire:key="item-{{ $key }}">
                                    <x-table.td>
                                        <x-button.icon.move wire:sortable.handle></x-button.icon.move>
                                        <x-form-input :name="'items['.$key.'][sort_order]'" :value="$item['sort_order']"
                                            style="display: none">
                                        </x-form-input>
                                    </x-table.td>
                                    <x-table.td>
                                        <x-form-select :name="'items['.$key.'][product_id]'"
                                            :value="$item['product_id']" :options="$products">
                                        </x-form-select>
                                    </x-table.td>
                                    <x-table.td>
                                        <x-form-input :name="'items['.$key.'][description]'"
                                            :value="$item['description']">
                                        </x-form-input>
                                    </x-table.td>
                                    <x-table.td>
                                        <x-form-input :name="'items['.$key.'][quantity]'" :value="$item['quantity']"
                                            wire:model="items.{{ $key }}.quantity">
                                        </x-form-input>
                                    </x-table.td>
                                    <x-table.td>
                                        <x-form-input :name="'items['.$key.'][price]'" :value="$item['price']"
                                            wire:model="items.{{ $key }}.price">
                                        </x-form-input>
                                    </x-table.td>
                                    <x-table.td>
                                        @money($item['price'] * $item['quantity'])
                                    </x-table.td>
                                    <x-table.td class="text-right">
                                        <x-button.icon.delete wire:click="removeItem({{ $key }})">
                                        </x-button.icon.delete>
                                    </x-table.td>
                                </x-table.tr>
                            @endforeach
                            <x-table.tr>
                                <x-table.td>
                                </x-table.td>
                                <x-table.td>
                                    <x-form-select name="item.product_id" wire:model="new.product_id"
                                        wire:change="changeProduct" :options="$products"
                                        :placeholder="__('Please select product')" />
                                </x-table.td>
                                <x-table.td>
                                    <x-form-input name="item.description" wire:model.lazy="new.description" />
                                </x-table.td>
                                <x-table.td>
                                    <x-form-input name="item.quantity" wire:model="new.quantity" />
                                </x-table.td>
                                <x-table.td>
                                    <x-form-input name="item.price" wire:model="new.price" />
                                </x-table.td>
                                <x-table.td>
                                    @money($new['price'] * $new['quantity'])
                                </x-table.td>
                                <x-table.td class="text-right">
                                    <x-button.icon.save wire:click.prevent="addProduct"></x-button.icon.save>
                                </x-table.td>
                            </x-table.tr>
                        </tbody>
                        <tfoot>
                            <x-table.tr>
                                <x-table.td colspan="5" class="text-right">
                                    {{ __('Total') }}
                                </x-table.td>
                                <x-table.td>
                                    @money($total)
                                </x-table.td>
                                <x-table.td>
                                </x-table.td>
                            </x-table.tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
