@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'border-gray-300 focus:border-gambus-secondary focus:ring-gambus-secondary rounded-md shadow-sm']) !!}>