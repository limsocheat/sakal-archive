<div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-5 p-5">
    <x-form.localize-input name="title" :label="__('Title')"></x-form.localize-input>
    <x-form-localized-text-editor name="content" :label="__('Content')" :key="'content'" height="350px">
    </x-form-localized-text-editor>
</div>
