<div>

    @isset($label)
        {!! Form::label($name, $label, ['class' => 'block mb-2 text-sm font-medium text-' . ($errors->has($name) ? 'red' : $color) . '-700 dark:text-' . ($errors->has($name) ? 'red' : $color) . '-500']) !!}
    @endisset
    {!! Form::number($name, $value, $attributes->merge(['class' => 'bg-' . ($errors->has($name) ? 'red' : $color) . '-50 border border-' . ($errors->has($name) ? 'red' : $color) . '-500 text-' . ($errors->has($name) ? 'red' : $color) . '-900 placeholder-' . ($errors->has($name) ? 'red' : $color) . '-700 text-sm rounded-lg focus:ring-' . ($errors->has($name) ? 'red' : $color) . '-500 focus:border-' . ($errors->has($name) ? 'red' : $color) . '-500 block w-full p-2.5 dark:bg-' . ($errors->has($name) ? 'red' : $color) . '-100 dark:border-' . ($errors->has($name) ? 'red' : $color) . '-400'])->getAttributes()) !!}

    @error($name)
        <p
            class="mt-2 text-sm text-{{ $errors->has($name) ? 'red' : $color }}-600 dark:text-{{ $errors->has($name) ? 'red' : $color }}-500">
            {{ $message }}</p>
    @enderror
</div>
