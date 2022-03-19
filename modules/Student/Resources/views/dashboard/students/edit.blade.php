<x-form-layout>
    {!! Form::model($item, ['route' => ['dashboard.students.update', $item], 'method' => 'put']) !!}

    <div class="p-5 bg-white">

        <div class="grid grid-cols-6 gap-x-6">
            <div class="col-span-6 sm:col-span-3">
                <x-form.localize-input name="first_name" :label="__('First Name')" :item="$item" :key="'first_name'">
                </x-form.localize-input>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-form.localize-input name="last_name" :label="__('Last Name')" :item="$item" :key="'last_name'">
                </x-form.localize-input>
            </div>
            <div class="col-span-6 sm:col-span-3">
                {!! Form::label('gender', 'Gender') !!}
                <div class="mt-2 flex flex-wrap space-x-6">
                    <x-form-radio name="gender" value="male" :label="__('Male')"></x-form-radio>
                    <x-form-radio name="gender" value="female" :label="__('Female')"></x-form-radio>
                </div>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-form-datepicker name="date_of_birth" placeholder="{{ __('Date of Birth') }}">
                </x-form-datepicker>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-form-input name="nationality" :label="__('Nationality')"></x-form-input>
            </div>
            <div class="col-span-6 sm:col-span-3">
                <x-form-input type="number" name="phone" :label="__('Phone')"></x-form-input>
            </div>
            <div class="col-span-6 sm:col-span-6">
                <x-form-input name="place_of_birth" :label="__('Birth of Place')"></x-form-input>
            </div>
            <div class="col-span-6 sm:col-span-6">
                <x-form-input name="address" :label="__('Address')"></x-form-input>
            </div>
        </div>
        {{ Form::submit('Update', ['class' =>'text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center mr-2 mb-2 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mt-5']) }}
    </div>
    {{ Form::close() }}

    <x-slot name="aside">
        Aside
    </x-slot>

    <x-slot name="footer">
        Footer
    </x-slot>
</x-form-layout>
