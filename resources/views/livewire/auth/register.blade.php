<div>
    <form wire:submit.prevent="register" class="bg-fit-lighter-gray px-6 py-8">
        @csrf

        <h3 class="text-center text-2xl mb-6 font-bold">Registrati</h3>

        <div>
            <div class="bg-white rounded-full">
                <div class="grid grid-cols-2">
                    @foreach($tabs as $tab => $label)
                        <div wire:click="$set('currentTab', '{{ $tab }}')"
                             class="{{ $tab == $currentTab ? 'font-bold text-white bg-fit-magenta' : 'text-fit-dark-gray hover:cursor-pointer' }} py-3 px-4 rounded-full text-center">
                            {{ $label }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if($currentTab == 'atlete')
            <div wire:key="tab-atlete">
                <div class="mt-4 mx-auto max-w-xs text-center">
                    <p class="leading-relaxed">Scansiona il QR code per scaricare l'app di FitMatch</p>
                </div>
                <div class="mt-4 text-center">
                    <div class="mx-auto w-44 aspect-square bg-white shadow-md"></div>
                </div>
            </div>
        @elseif($currentTab == 'personal-trainer')
            <div wire:key="personal-trainer-tab">
                <!-- Email Address -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')"/>
                    <x-text-input wire:model="email" id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                                  required autocomplete="username"/>
                    <x-input-error :messages="$errors->get('email')" class="mt-2"/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')"/>

                    <x-text-input wire:model="password" id="password" class="block mt-1 w-full"
                                  type="password"
                                  name="password"
                                  required autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')"/>

                    <x-text-input wire:model="password_confirmation" id="password_confirmation" class="block mt-1 w-full"
                                  type="password"
                                  name="password_confirmation" required autocomplete="new-password"/>

                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2"/>
                </div>

                <div class="block mt-4">
                    <label class="inline-flex items-center">
                        <input wire:model="terms" type="checkbox"
                               class="border-2 border-gray-400 w-6 h-6 text-fit-magenta bg-fit-lighter-gray focus:ring-fit-light-blue"
                               name="remember">
                        <span class="ml-2 text-sm text-gray-600">Accetto la <a href="#" class="font-bold text-fit-black">Privacy Policy</a> e <a
                                href="#" class="font-bold text-fit-black">Termini e Condizioni</a> di FitMatch Pro</span>
                    </label>
                </div>
                <div class="flex items-center justify-end mt-4">
                    <x-primary-button class="w-full justify-center" :disabled="!$terms">
                        Iniziamo!
                    </x-primary-button>
                </div>
            </div>
        @endif

        <div class="mt-4 text-center">
            <p>
                Hai già un account?
                <a class="underline text-sm text-fit-purple-blue hover:text-fit-magenta rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                   href="{{ route('login') }}">
                    Accedi
                </a>
            </p>
        </div>
    </form>
</div>
