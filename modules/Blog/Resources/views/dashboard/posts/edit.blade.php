<x-app-layout>
    <x-form action="{{ route('dashboard.posts.update', $post) }}" method="PUT">

        <x-slot name="header">
            {{ __('blog::Edit Post') }}
        </x-slot>

        @bind($post)
        <x-blog::form.post-form>
        </x-blog::form.post-form>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-5 p-5">
            <x-form-select name="status" :label="__('Status')" :options="$statuses"></x-form-select>
            <x-tailwind-form-submit></x-tailwind-form-submit>
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-5 p-5">
            <span>{{ __('Categories') }}</span>
            <livewire:blog::post-category-form />
        </div>

        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-5 p-5">
            <span>{{ __('Tags') }}</span>
            <livewire:blog::post-tags-form />
        </div>

        <x-form-featured-image :label="__('Featured Image')" name="featured_image_id"
            id="{{ $post->featured_image_id }}" featured_image_url="{{ $post->featured_image_url }}">
        </x-form-featured-image>
        @endbind


    </x-form>



</x-app-layout>
