<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-fit-purple-blue border border-transparent rounded-md font-semibold text-white tracking-widest hover:bg-fit-magenta focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:bg-fit-dark-gray disabled:cursor-not-allowed']) }}>
    {{ $slot }}
</button>
