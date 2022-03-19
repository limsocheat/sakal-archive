<x-form-layout>
    <x-tailwind-form :action="route('dashboard.students.store')">
        <div class="p-5 bg-white">
            <div class="grid grid-cols-6 gap-x-6">
                <div class="col-span-6 sm:col-span-2">
                    <x-form-input name="major" :label="__('Major')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    {!! Form::label('shift', 'Shift') !!}
                    <div class="mt-2 flex flex-wrap space-x-6">
                        <x-form-radio name="shift" value="morning" :label="__('Morning')"></x-form-radio>
                        <x-form-radio name="shift" value="ofternoon" :label="__('Ofternoon')"></x-form-radio>
                        <x-form-radio name="shift" value="evening" :label="__('Evening')"></x-form-radio>
                        <x-form-radio name="shift" value="weekend" :label="__('Weekend')"></x-form-radio>
                    </div>
                </div>
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

                <div class="col-span-6 sm:col-span-2">
                    <x-form-input name="nationality" :label="__('Nationality')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <x-form-input name="national" :label="(__('National'))"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <x-form-input type="number" name="phone" :label="__('Phone')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-6 py-2">
                    {!! Form::label('data_of_birth', 'Data of Birth', ['class' => 'text-blue-700']) !!}
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form-input name="village" :label="__('Village')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form-input name="commune" :label="__('Commune')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form-input name="district" :label="__('District')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form-input name="province" :label="__('Province')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-4">
                    <x-form-input name="student_from" :label="__('Student From')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-2">
                    <x-form-input name="student_from_province" :label="__('Province')"></x-form-input>
                </div>

                <div class="col-span-6 sm:col-span-6 py-2">
                    {!! Form::label('address', 'Address', ['class' => 'text-blue-700']) !!}
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form-input name="village" :label="__('Village')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form-input name="commune" :label="__('Commune')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form-input name="district" :label="__('District')"></x-form-input>
                </div>
                <div class="col-span-6 sm:col-span-3">
                    <x-form-input name="province" :label="__('Province')"></x-form-input>
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
