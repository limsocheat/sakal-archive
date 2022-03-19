<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Edit Category') }}
        </h2>
    </x-slot>

    <div class="py-6">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-form action="{{ route('dashboard.categories.update', $category) }}" method="PUT">
                @bind($category)
                <x-blog::form.category-form>
                </x-blog::form.category-form>
                @endbind
            </x-form>
        </div>
    </div>
</x-app-layout>
