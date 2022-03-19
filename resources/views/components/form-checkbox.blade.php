<div>
    <div class="flex items-center mb-4">
        {!! Form::checkbox($name, $value, false, ['class' => 'w-4 h-4 border-gray-300 focus:ring-2 focus:ring-blue-300 dark:focus:ring-blue-600 dark:focus:bg-blue-600 dark:bg-gray-700 dark:border-gray-600']) !!}
        @isset($label)
            {!! Form::label($name, $label, ['class' => 'block ml-2 text-sm font-medium text-gray-900 dark:text-gray-300']) !!}
        @endisset
    </div>
</div>
