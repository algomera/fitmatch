@props(['status'])

@if ($status)
    <div {{ $attributes->merge(['class' => 'font-fit-medium text-sm text-green-600']) }}>
        {{ $status }}
    </div>
@endif
