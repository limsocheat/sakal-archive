<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Create Tag') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form action="{{ route('dashboard.tags.store') }}" method="POST">
                <x-blog::form.tag-form>
                </x-blog::form.tag-form>
            </x-form>
        </div>
    </div>
</x-app-layout>
