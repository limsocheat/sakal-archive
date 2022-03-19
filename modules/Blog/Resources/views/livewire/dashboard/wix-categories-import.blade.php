<div>
    <x-form-input name="endpoint" label="{{ __('Endpoint') }}" :value="'https://www.wixapis.com/blog/v3/categories'"
        readonly></x-form-input>
    <x-form-input name="token" label="{{ __('Token') }}"></x-form-input>
    <x-form-input name="offset" label="{{ __('Offset') }}" type="number"></x-form-input>
    <x-form-input name="limit" label="{{ __('Limit') }}" type="number"></x-form-input>
    <x-tailwind-form-submit type="button">{{ __('Import') }}</x-tailwind-form-submit>
</div>
