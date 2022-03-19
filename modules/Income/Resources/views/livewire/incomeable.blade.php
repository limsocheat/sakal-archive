<div>
    <div class="col-span-6 sm:col-span-3">
        <div class="mt-2 flex flex-wrap space-x-6">
            @foreach ($types as $value => $label)
                <x-form-radio name="incomeable_type" value="{{ $value }}" label="{{ $label }}"
                    wire:model="type">
                </x-form-radio>
            @endforeach
        </div>
        <div class="mt-2">
            <x-form-select name="incomeable_id" :label="__('Customer')" :options="$incomeables">
            </x-form-select>
        </div>
    </div>

</div>
