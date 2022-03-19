<x-form-layout>
    <x-tailwind-form :action="route('dashboard.students.store')">
        <div class="p-5 bg-white">
            <div class="grid grid-cols-6 gap-x-6">
                <div class="col-span-6 sm:col-span-3">
                    <x-form.localize-input name="first_name" :label="__('First Name')" :key="'first_name'" item="">
                    </x-form.localize-input>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form.localize-input name="last_name" :label="__('Last Name')" :key="'last_name'" item="">
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
            <x-tailwind-form-submit></x-tailwind-form-submit>
        </div>
    </x-tailwind-form>

    <x-slot name="aside">
        Aside
    </x-slot>

    <x-slot name="footer">
        Footer
    </x-slot>
</x-form-layout>
