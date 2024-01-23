<nav x-data="{ open: false }" class="relative bg-white shadow-md z-10">
    <div class="mx-auto max-w-7xl px-2 sm:px-4 lg:px-8">
        <div class="flex h-16 justify-between">
            <div class="flex flex-1">
                <a href="{{ route(auth()->user()->role->name.'.dashboard') }}"
                   class="flex flex-shrink-0 items-center mr-2">
                    <x-application-logo class="block h-7 w-auto fill-current text-gray-800"/>
                </a>
            </div>
            <div class="hidden lg:flex px-2 lg:px-0">
                <div class="lg:ml-6 lg:flex lg:space-x-8">
                    {{-- Admin --}}
                    @role('admin')
                    <x-nav-link :href="route('admin.requests')" :active="request()->routeIs('admin.requests*')">
                        {{ __('Richieste') }}
                    </x-nav-link>
                    <x-nav-link href="#" :active="request()->routeIs('admin.subscribers*')">
                        {{ __('Lista iscritti') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('admin.exercises') }}" :active="request()->routeIs('admin.exercises*')">
                        {{ __('Esercizi') }}
                    </x-nav-link>
                    @endrole
                    @role('personal-trainer')
                    <x-nav-link href="{{ route('personal-trainer.athletes') }}"
                                :active="request()->routeIs('personal-trainer.athletes*')">
                        {{ __('Atleti') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('personal-trainer.workouts') }}"
                                :active="request()->routeIs('personal-trainer.workouts*')">
                        {{ __('Schede') }}
                    </x-nav-link>
                    <x-nav-link href="{{ route('personal-trainer.exercises') }}"
                                :active="request()->routeIs('personal-trainer.exercises*')">
                        {{ __('Esercizi') }}
                    </x-nav-link>
                    <x-primary-button
                        x-on:click="Livewire.emit('openModal', 'personal-trainer.workouts.modals.create-workout')"
                        class="self-center">
                        Crea scheda
                    </x-primary-button>
                    @endrole
                </div>
            </div>
            <div class="flex items-center lg:hidden">
                <!-- Mobile menu button -->
                <button x-cloak x-on:click="open = !open" type="button"
                        class="inline-flex items-center justify-center rounded-md p-2 text-gray-400 hover:bg-gray-100 hover:text-gray-500 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500"
                        aria-controls="mobile-menu" aria-expanded="false">
                    <span class="sr-only">Open main menu</span>
                    <svg x-cloak :class="{'block': !open, 'hidden': open}" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round"
                              d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5"/>
                    </svg>
                    <svg x-cloak :class="{'block': open, 'hidden': !open}" class="h-6 w-6" fill="none"
                         viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" aria-hidden="true">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                    </svg>
                </button>
            </div>
            <div class="hidden lg:flex lg:items-center">
                <!-- Profile dropdown -->
                <div class="hidden sm:flex sm:items-center sm:ml-3">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button
                                class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-500 bg-white hover:text-gray-700 focus:outline-none transition ease-in-out duration-150">
                                <div class="relative">
                                    @if(auth()->user()->avatar())
                                        <img class="h-8 w-8 rounded-full"
                                             src="{{ auth()->user()->avatar() }}" alt="">
                                    @else
                                        <x-heroicon-o-user-circle class="h-8 w-8"></x-heroicon-o-user-circle>
                                    @endif
                                    @if(auth()->user()->role->name === 'personal-trainer' && !auth()->user()->stripe_account_id)
                                        <div class="absolute rounded-full bg-white -top-0.5 -right-0.5">
                                            <x-heroicon-o-exclamation-circle
                                                class="text-red-600 w-4 h-4"></x-heroicon-o-exclamation-circle>
                                        </div>
                                    @endif
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            @role('personal-trainer')
                            <x-dropdown-link :href="route('personal-trainer.profile')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            @endrole
                            @role('admin')
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Profile') }}
                            </x-dropdown-link>
                            @endrole

                            <!-- Authentication -->
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf

                                <x-dropdown-link :href="route('logout')"
                                                 onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                    {{ __('Log Out') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
            </div>
        </div>
    </div>

    <!-- Mobile menu, show/hide based on menu state. -->
    <div x-cloak x-show="open" class="lg:hidden" id="mobile-menu">
        <div class="space-y-1 pb-3 pt-2">
            @role('admin')
            <x-responsive-nav-link href="{{ route('admin.requests') }}" :active="request()->routeIs('admin.requests*')">
                {{ __('Richieste') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="#" :active="request()->routeIs('admin.subscribers*')">
                {{ __('Lista iscritti') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('admin.exercises') }}"
                                   :active="request()->routeIs('admin.exercises*')">
                {{ __('Esercizi') }}
            </x-responsive-nav-link>
            @endrole
            @role('personal-trainer')
            <x-responsive-nav-link href="{{ route('personal-trainer.athletes') }}"
                                   :active="request()->routeIs('personal-trainer.athletes*')">
                {{ __('Atleti') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('personal-trainer.workouts') }}"
                                   :active="request()->routeIs('personal-trainer.workouts*')">
                {{ __('Schede') }}
            </x-responsive-nav-link>
            <x-responsive-nav-link href="{{ route('personal-trainer.exercises') }}"
                                   :active="request()->routeIs('personal-trainer.exercises*')">
                {{ __('Esercizi') }}
            </x-responsive-nav-link>
            <div class="mx-4">
                <x-primary-button
                    x-on:click="Livewire.emit('openModal', 'personal-trainer.workouts.modals.create-workout')"
                    class="w-full justify-center">
                    Crea scheda
                </x-primary-button>
            </div>
            @endrole
        </div>
        <div class="border-t border-gray-200 pb-3 pt-4">
            <div class="flex items-center px-4">
                <div class="flex-shrink-0">
                    @if(auth()->user()->avatar())
                        <img class="h-10 w-10 rounded-full"
                             src="{{ auth()->user()->avatar() }}" alt="">
                    @else
                        <x-heroicon-o-user-circle class="h-10 w-10"></x-heroicon-o-user-circle>
                    @endif
                </div>
                <div class="ml-3">
                    <div class="text-base font-medium text-gray-800">{{ auth()->user()->full_name }}</div>
                    <div class="text-sm font-medium text-gray-500">{{ auth()->user()->email }}</div>
                </div>
            </div>
            <div class="mt-3 space-y-1">
                @role('personal-trainer')
                <x-responsive-nav-link :href="route('personal-trainer.profile')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @endrole
                @role('admin')
                <x-responsive-nav-link :href="route('profile.edit')">
                    {{ __('Profile') }}
                </x-responsive-nav-link>
                @endrole

                <!-- Authentication -->
                <form method="POST" action="{{ route('logout') }}">
                    @csrf

                    <x-responsive-nav-link :href="route('logout')"
                                           onclick="event.preventDefault();
                                        this.closest('form').submit();">
                        {{ __('Log Out') }}
                    </x-responsive-nav-link>
                </form>
            </div>
        </div>
    </div>
</nav>
