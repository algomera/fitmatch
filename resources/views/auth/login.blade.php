<x-auth-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <form method="POST" action="{{ route('login') }}" class="bg-fit-lighter-gray px-6 py-8">
        @csrf

        <h3 class="text-center text-2xl mb-6 font-bold">Accedi</h3>

        <!-- Email Address -->
        <div>
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="block mt-1 w-full"
                            type="password"
                            name="password"
                            required autocomplete="current-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <div class="mt-4 text-center">
            @if (Route::has('password.request'))
                <a class="underline text-sm text-fit-purple-blue hover:text-fit-magenta rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                    Password dimenticata?
                </a>
            @endif
        </div>

        <!-- Remember Me -->
{{--        <div class="block mt-4">--}}
{{--            <label for="remember_me" class="inline-flex items-center">--}}
{{--                <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">--}}
{{--                <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>--}}
{{--            </label>--}}
{{--        </div>--}}

        <div class="flex items-center justify-center mt-4">
            <x-primary-button class="w-full justify-center">
                Iniziamo!
            </x-primary-button>
        </div>

        <div class="mt-4 text-center">
            <p>
                Non hai ancora un account?
                <a class="underline text-sm text-fit-purple-blue hover:text-fit-magenta rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('register') }}">
                    Iscriviti
                </a>
            </p>
        </div>
    </form>
</x-auth-layout>
