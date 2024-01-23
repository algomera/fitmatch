<div>
    <form wire:submit.prevent="register" class="bg-fit-lighter-gray px-6 py-8">
        @csrf

        <h2 class="text-center mb-6">Registrati</h2>

        <div>
            <div class="bg-white rounded-full">
                <div class="grid grid-cols-2">
                    @foreach($tabs as $tab => $label)
                        <div wire:click="$set('currentTab', '{{ $tab }}')"
                             class="{{ $tab == $currentTab ? 'font-fit-bold text-white bg-fit-magenta' : 'text-fit-dark-gray hover:cursor-pointer' }} py-3 px-4 rounded-full text-center">
                            {{ $label }}
                        </div>
                    @endforeach
                </div>
            </div>
        </div>

        @if($currentTab == 'athlete')
            <div wire:key="tab-athlete">
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
                    <x-input wire:model="email" id="email" type="email" name="email" :value="old('email')" label="Email"
                             required autofocus/>
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input wire:model="password" id="password" type="password" name="password" label="Password"
                             required/>
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input wire:model="password_confirmation" id="password_confirmation" type="password"
                             name="password_confirmation" label="Conferma Password" required/>
                </div>

                <div class="block mt-4">
                    <label class="inline-flex items-center">
                        <input wire:model="terms" type="checkbox"
                               class="border-2 border-gray-400 w-6 h-6 text-fit-magenta bg-fit-lighter-gray focus:ring-fit-light-blue"
                               name="remember">
                        <span class="ml-5 text-sm text-gray-600">Accetto la <a href="#"
                                                                               class="font-fit-bold text-fit-black">Privacy Policy</a> e <a
                                href="#"
                                class="font-fit-bold text-fit-black">Termini e Condizioni</a> di FitMatch Pro</span>
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
