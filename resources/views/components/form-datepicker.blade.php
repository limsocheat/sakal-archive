<div>
    <div class="relative">
        <div class="flex absolute inset-y-0 left-0 items-center pl-3 pointer-events-none">
            <svg class="w-5 h-5 text-{{ $errors->has($name) ? 'red' : $color }}-500 dark:text-{{ $errors->has($name) ? 'red' : $color }}-400"
                fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd"
                    d="M6 2a1 1 0 00-1 1v1H4a2 2 0 00-2 2v10a2 2 0 002 2h12a2 2 0 002-2V6a2 2 0 00-2-2h-1V3a1 1 0 10-2 0v1H7V3a1 1 0 00-1-1zm0 5a1 1 0 000 2h8a1 1 0 100-2H6z"
                    clip-rule="evenodd"></path>
            </svg>
        </div>

        {!! Form::text(
    $name,
    $value,
    $attributes->merge([
            'class' => 'bg-' . ($errors->has($name) ? 'red' : $color) . '-50 border border-' . ($errors->has($name) ? 'red' : $color) . '-300 text-' . ($errors->has($name) ? 'red' : $color) . '-900 sm:text-sm rounded-lg focus:ring-blue-500 focus:border-blue-500 block w-full pl-10 p-2.5  dark:bg-' . ($errors->has($name) ? 'red' : $color) . '-700 dark:border-' . ($errors->has($name) ? 'red' : $color) . '-600 dark:placeholder-' . ($errors->has($name) ? 'red' : $color) . '-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500',
            'placeholder' => $placeholder,
            'datepicker-buttons' => $buttons,
            'datepicker-autohide' => $autoHide,
            'datepicker' => true,
            'datepicker-format' => 'yyyy-mm-dd',
        ])->getAttributes(),
) !!}
    </div>

    @error($name)
        <p
            class="mt-2 text-sm text-{{ $errors->has($name) ? 'red' : $color }}-600 dark:text-{{ $errors->has($name) ? 'red' : $color }}-500">
            {{ $message }}</p>
    @enderror
</div>

@push('scripts')
    <script src="https://unpkg.com/flowbite@1.3.4/dist/datepicker.js"></script>
@endpush
