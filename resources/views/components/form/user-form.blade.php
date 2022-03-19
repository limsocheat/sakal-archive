<div class="md:grid md:grid-cols-3 md:gap-6">
    <div class="md:col-span-1">
        <div class="px-4 sm:px-0">
            <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
            <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive mail.</p>
        </div>
    </div>
    <div class="mt-5 md:mt-0 md:col-span-2">
        <div class="shadow overflow-hidden sm:rounded-md">
            <div class="px-4 py-5 bg-white sm:p-6">
                <x-form-input name="name" :label="__('Name')"></x-form-input>
                <x-form-input name="email" type="email" :label="__('Email')"></x-form-input>
                <x-form-select name="role_id" :label="__('Role')" :options="$roles"></x-form-select>
                @if ($type == 'create')
                    <x-form-input name="password" type="password" :label="__('Password')">
                    </x-form-input>
                    <x-form-input name="password_confirmation" type="password" :label="__('Confirm Password')">
                    </x-form-input>
                @endif
                <x-tailwind-form-submit></x-tailwind-form-submit>
            </div>
        </div>
    </div>
</div>
