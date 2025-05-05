@props([
    'disabled' => false,
    'type' => 'text',
    'name',
    'value' => '',
])

<input
    {{ $attributes->merge([
        'class' => 'border-gray-300 focus:border-indigo-500 focus:ring-indigo-500 rounded-md shadow-sm'
    ]) }}
    type="{{ $type }}"
    name="{{ $name }}"
    value="{{ old($name, $value) }}"
    @if($disabled) disabled @endif
>
