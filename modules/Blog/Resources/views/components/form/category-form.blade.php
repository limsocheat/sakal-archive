<main class="grid grid-cols-4 gap-5">
    <article class="col-span-3">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-5 p-5">
            <x-form.localize-input name="title" :label="__('Title')"></x-form.localize-input>
            <x-form-localized-text-editor name="content" :label="__('Content')" :key="'content'" rows="20">
            </x-form-localized-text-editor>
        </div>
    </article>
    <aside class="col-span-1 space-y-5">
        <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg space-y-5 p-5">
            <x-tailwind-form-submit class="w-full justify-center"></x-tailwind-form-submit>
        </div>
    </aside>
</main>
