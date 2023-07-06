@props(['active'])

@php
$classes = ($active ?? false)
            ? 'block w-full pl-3 pr-4 py-2 border-l-4 border-fit-magenta text-left text-base font-semibold text-fit-magenta bg-fit-magenta/10 focus:outline-none focus:text-fit-magenta focus:bg-fit-magenta/10 focus:border-fit-magenta transition duration-150 ease-in-out'
            : 'block w-full pl-3 pr-4 py-2 border-l-4 border-transparent text-left text-base text-fit-black hover:text-fit-magenta hover:bg-fit-magenta/10 hover:border-fit-magenta focus:outline-none focus:text-fit-magenta focus:bg-fit-magenta/10 focus:border-fit-magenta transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
