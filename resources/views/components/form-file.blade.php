<div>
    @isset($label)
        {!! Form::label($name, $label, ['class' => 'block mb-2 text-sm font-medium text-' . ($errors->has($name) ? 'red' : $color) . '-700 dark:text-' . ($errors->has($name) ? 'red' : $color) . '-500']) !!}
    @endisset
    {!! Form::file($name, $value, $attributes->merge(['class' => 'block w-full text-sm text-' . ($errors->has($name) ? 'red' : $color) . '-900 bg-' . ($errors->has($name) ? 'red' : $color) . '-50 rounded-lg border border-' . ($errors->has($name) ? 'red' : $color) . '-300 cursor-pointer dark:text-' . ($errors->has($name) ? 'red' : $color) . '-400 focus:outline-none focus:border-transparent dark:bg-' . ($errors->has($name) ? 'red' : $color) . '-700 dark:border-' . ($errors->has($name) ? 'red' : $color) . '-600 dark:placeholder-' . ($errors->has($name) ? 'red' : $color) . '-400'])->getAttributes()) !!}

    @error($name)
        <p
            class="mt-2 text-sm text-{{ $errors->has($name) ? 'red' : $color }}-600 dark:text-{{ $errors->has($name) ? 'red' : $color }}-500">
            {{ $message }}</p>
    @enderror
</div>
