@props(['value', 'required' => false])

<label {{ $attributes->merge(['class' => 'block font-fit-medium text-sm text-gray-700']) }}>
    {{ $value ?? $slot }}
    @if($required)
        <span class="text-red-500">*</span>
    @endif
</label>
