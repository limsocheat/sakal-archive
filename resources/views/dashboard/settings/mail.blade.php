<x-setting-layout>
    <x-tailwind-form :action="route('dashboard.settings.mail.store')">
        @bind($settings)
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
            <div class="p-6">
                <div class="md:grid md:grid-cols-3 md:gap-6">
                    <div class="md:col-span-1">
                        <div class="px-4 sm:px-0">
                            <h3 class="text-lg font-medium leading-6 text-gray-900">App Setting</h3>
                            <p class="mt-1 text-sm text-gray-600">Modified App Setting</p>
                        </div>
                    </div>
                    <div class="mt-5 md:mt-0 md:col-span-2">

                        <div class="shadow overflow-hidden sm:rounded-md">
                            <div class="px-4 py-5 bg-white sm:p-6">
                                <div class="grid grid-cols-6 gap-x-6">

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-form-input name="mailer" :label="__('Mail Mailer')">
                                        </x-form-input>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-form-input name="host" :label="__('Mail Host')">
                                        </x-form-input>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-form-input name="username" :label="__('Mail Username')">
                                        </x-form-input>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-form-input name="password" :label="__('Mail Password')" type="password">
                                        </x-form-input>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-form-input name="port" :label="__('Mail Port')">
                                        </x-form-input>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-form-input name="encryption" :label="__('Mail Encryption')">
                                        </x-form-input>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-form-input name="from_address" :label="__('Mail From Address')">
                                        </x-form-input>
                                    </div>

                                    <div class="col-span-6 sm:col-span-3">
                                        <x-form-input name="from_name" :label="__('Mail From Name')">
                                        </x-form-input>
                                    </div>
                                </div>
                            </div>
                            <x-tailwind-form-submit class="mx-4 my-3 bg-gray-50 text-right sm:mx-6">
                            </x-tailwind-form-submit>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endbind
        </x-form>
</x-setting-layout>
