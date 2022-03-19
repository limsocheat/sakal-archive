<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Vendor') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-10 py-5">
                <x-form action="{{ route('dashboard.vendors.update', $vendor) }}" method="PUT">
                    @bind($vendor)
                    <x-vendor::form.vendor>
                    </x-vendor::form.vendor>
                    @endbind
                </x-form>
            </div>
        </div>
    </div>
</x-app-layout>
