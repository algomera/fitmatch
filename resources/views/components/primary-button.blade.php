@props(['color' => 'blue', 'rounded' => false])

@switch($color)
    @case('blue')
        @php($classes = 'bg-fit-purple-blue border border-transparent text-white hover:bg-fit-purple-blue/90 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ')
        @break
    @case('magenta')
        @php($classes = 'bg-fit-magenta border border-transparent text-white hover:bg-fit-magenta/70 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ')
        @break
    @case('gray')
        @php($classes = 'bg-fit-dark-gray/70 border border-transparent text-white hover:bg-fit-dark-gray/80 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ')
        @break
    @case('ghost')
        @php($classes = 'bg-transparent border border-fit-dark-gray/80 text-fit-dark-gray hover:text-fit-dark-gray/80 hover:border-fit-dark-gray/50 active:bg-gray-700 focus:ring-indigo-500 ')
        @break
    @case('link')
        @php($classes = 'bg-transparent border-0 text-fit-dark-gray hover:text-fit-dark-gray/80 focus:text-gray-700 active:text-gray-900 focus:ring-indigo-500 ')
        @break
    @case('red')
        @php($classes = 'bg-red-600 border border-transparent text-white hover:bg-red-500 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 ')
        @break
@endswitch
@if($rounded)
    @php($classes .= 'rounded-full ')
@else
    @php($classes .= 'rounded-md ')
@endif

<button {{ $attributes->merge(['type' => 'submit', 'class' => $classes . 'text-sm inline-flex items-center px-5 py-1.5 font-semibold tracking-widest focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:bg-fit-dark-gray disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
