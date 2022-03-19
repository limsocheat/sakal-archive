<div class="space-y-10 px-6">
    <div class="mt-10 sm:mt-0">
        <div class="md:grid md:grid-cols-3 md:gap-6">
            <div class="md:col-span-1">
                <div class="px-4 sm:px-0">
                    <h3 class="text-lg font-medium leading-6 text-gray-900">Personal Information</h3>
                    <p class="mt-1 text-sm text-gray-600">Use a permanent address where you can receive
                        mail.</p>
                </div>
            </div>
            <div class="mt-5 md:mt-0 md:col-span-2">

                <div class="shadow overflow-hidden sm:rounded-md">
                    <div class="px-4 py-5 bg-white sm:p-6">
                        <div class="grid grid-cols-6 gap-x-6">

                            <div class="col-span-6 sm:col-span-6">
                                <x-form-input name="legal_name" :label="__('legal Name')">
                                </x-form-input>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <x-form-input name="company_name" :label="__('Company Name')">
                                </x-form-input>
                            </div>

                            <div class="col-span-6 sm:col-span-6">
                                <x-form-input name="title" :label="__('Mr., Mrs., Mdam.')">
                                </x-form-input>
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <x-form-input name="first_name" :label="__('First Name')">
                                </x-form-input>
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <x-form-input name="middle_name" :label="__('Middle Name')">
                                </x-form-input>
                            </div>

                            <div class="col-span-6 sm:col-span-2">
                                <x-form-input name="last_name" :label="__('Last Name')">
                                </x-form-input>
                            </div>
                        </div>
                    </div>
                    <x-tailwind-form-submit class="mx-4 my-3 bg-gray-50 text-right sm:mx-6"></x-tailwind-form-submit>
                </div>
            </div>
        </div>
    </div>
</div>
