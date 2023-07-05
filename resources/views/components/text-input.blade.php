@props(['disabled' => false])

<input {{ $disabled ? 'disabled' : '' }} {!! $attributes->merge(['class' => 'w-full border-0 focus:border-fit-light-blue focus:ring-fit-light-blue rounded-xl shadow-sm']) !!}>
