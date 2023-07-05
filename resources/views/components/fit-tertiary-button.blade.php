<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 border-fit-dark-gray border-2 rounded-md font-semibold text-fit-dark-gray tracking-widest hover:bg-fit-dark-gray hover:text-white focus:outline-none focus:ring-2 focus:ring-fit-magenta focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:bg-fit-dark-gray disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
