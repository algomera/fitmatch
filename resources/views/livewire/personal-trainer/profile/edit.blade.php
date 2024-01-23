<div class="mx-auto max-w-7xl lg:flex lg:gap-x-16 lg:px-8">
    <aside
        class="flex overflow-x-auto border-b border-gray-900/5 py-4 lg:block lg:w-64 lg:flex-none lg:border-0 lg:py-20">
        <nav class="flex gap-x-3 gap-y-3 whitespace-nowrap lg:flex-col">
            @foreach($tabs as $k => $tab)
                <span wire:click="$set('currentTab', '{{ $k }}')"
                      class="{{ $currentTab === $k ? 'bg-fit-magenta text-white' : 'text-fit-dark-gray cursor-pointer hover:text-fit-magenta' }} flex items-center justify-between rounded-full px-5 py-1 text-sm font-medium">
                    <span>{{ $tab }}</span>
                    @if($k === 'account' && !auth()->user()->stripe_account_id)
                        <x-heroicon-o-exclamation-circle
                            class="{{ $currentTab === $k ? 'text-white' : 'text-red-600' }} w-5 h-5"></x-heroicon-o-exclamation-circle>
                    @endif
                </span>
            @endforeach
        </nav>
    </aside>

    <main class="px-4 py-16 sm:px-6 lg:flex-auto lg:px-0 lg:py-20">
        <div class="mx-auto max-w-2xl space-y-10 lg:mx-0 lg:max-w-none">
            <div class="flex space-x-5 items-center border-b-white border-b-2 pb-10">
                <div class="relative">
                    <div
                        class="flex items-center justify-center w-40 h-40 overflow-hidden rounded-full border-2 border-white shadow-md">
                        @if(auth()->user()->avatar())
                            <img class="h-40 w-40"
                                 src="{{ auth()->user()->avatar() }}" alt="">
                        @else
                            <x-heroicon-o-user-circle class="h-36 w-36"></x-heroicon-o-user-circle>
                        @endif
                        <label class="group" for="profile_image_upload">
                            <input wire:model="profile_image" type="file" accept="image/*" id="profile_image_upload"
                                   class="sr-only">
                            <div
                                class="absolute grid place-items-center top-1 right-5 w-6 h-6 bg-fit-magenta rounded-full group-hover:cursor-pointer group-hover:bg-fit-purple">
                                <x-heroicon-o-pencil class="w-3 h-3 text-white"></x-heroicon-o-pencil>
                            </div>
                        </label>
                    </div>
                </div>
                <div>
                    <h3 class="text-xl uppercase font-extrabold">{{ auth()->user()->informations->first_name }}</h3>
                    <h3 class="text-xl uppercase font-extrabold">{{ auth()->user()->informations->last_name }}</h3>
                    <h5 class="mt-5 text-sm">Iscritto dal {{ auth()->user()->created_at->format('d/m/Y') }}</h5>
                    @if(auth()->user()->subscriptions()->first())
                        <h6 class="text-fit-magenta font-semibold text-sm mt-2 space-x-1">
                        <span
                            class="inline-flex items-center rounded-md bg-fit-magenta/20 px-2 py-1 text-xs font-medium text-fit-magenta ring-1 ring-inset ring-fit-magenta/5">{{ config('fitmatch.plans.'.auth()->user()->subscriptions()->first()->stripe_price) }}</span>
                            <a href="{{ route('personal-trainer.billing') }}"
                               class="text-xs text-fit-dark-gray hover:text-fit-magenta hover:underline hover:cursor-pointer">Modifica</a>
                        </h6>
                    @endif
                </div>
            </div>
            <div>
                @if($currentTab === 'personal_informations')
                    <div>
                        <div class="px-4 sm:px-0">
                            <h3 class="text-2xl font-semibold leading-7 text-gray-900">Informazioni personali</h3>
                        </div>
                        <div class="mt-6">
                            <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div class="border-t border-gray-100 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Nome</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ auth()->user()->informations->first_name }}</dd>
                                </div>
                                <div class="border-t border-gray-100 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Cognome</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ auth()->user()->informations->last_name }}</dd>
                                </div>
                                <div class="border-t border-gray-100 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Data di nascita</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ auth()->user()->informations->dob->format('d/m/Y') }}</dd>
                                </div>
                                <div class="border-t border-gray-100 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Telefono</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ auth()->user()->informations->phone }}</dd>
                                </div>
                                <div class="border-t border-gray-100 sm:col-span-2 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Biografia</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ auth()->user()->informations->bio }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                @endif
                @if($currentTab === 'company_informations')
                    <div>
                        <div class="px-4 sm:px-0">
                            <h3 class="text-2xl font-semibold leading-7 text-gray-900">Informazioni aziendali</h3>
                        </div>
                        <div class="mt-6">
                            <dl class="grid grid-cols-1 gap-6 sm:grid-cols-2">
                                <div class="border-t border-gray-100 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Nome azienda</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ auth()->user()->informations->company_name }}</dd>
                                </div>
                                <div class="border-t border-gray-100 sm:col-span-2 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Indirizzo</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">
                                        {{ auth()->user()->informations->company_address }}
                                        , {{ auth()->user()->informations->company_civic }}
                                        - {{ auth()->user()->informations->company_zip_code }} {{ auth()->user()->informations->company_city }}</dd>
                                </div>
                                <div class="border-t border-gray-100 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">P.IVA</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ auth()->user()->informations->company_vat_number ?? '-' }}</dd>
                                </div>
                                <div class="border-t border-gray-100 sm:col-span-1 sm:px-0">
                                    <dt class="text-sm font-medium leading-6 text-gray-900">Codice Fiscale</dt>
                                    <dd class="mt-1 text-sm leading-6 text-gray-700 sm:mt-2">{{ auth()->user()->informations->company_fiscal_code ?? '-' }}</dd>
                                </div>
                            </dl>
                        </div>
                    </div>
                @endif
                @if($currentTab === 'job_experiences')
                    <div class="px-4 sm:px-0">
                        <h3 class="text-2xl font-semibold leading-7 text-gray-900">Esperienze lavorative</h3>
                    </div>
                    <div class="divide-y mt-6">
                        @foreach($job_experiences as $job_experience)
                            <div class="not-prose py-5" wire:key="{{$job_experience->id}}">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-fit-black text-xl font-bold">{{ $job_experience->title }}</h3>
                                    <div class="flex items-center space-x-4">
                                        <svg
                                            wire:click="$emit('openModal', 'onboarding.step8.modals.edit-job', {{ json_encode(['job' => $job_experience->id]) }})"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 cursor-pointer hover:text-fit-purple-blue">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="font-bold text-fit-magenta">{{ $job_experience->company }}
                                        - {{ $job_experience->city }}</p>
                                    <p class="text-fit-black capitalize">{{ \Carbon\Carbon::parse($job_experience->start_date)->monthName }} {{ $job_experience->start_date->format('Y') }}
                                        - {{ \Carbon\Carbon::parse($job_experience->end_date)->monthName }} {{ $job_experience->end_date->format('Y') }}</p>
                                    <p class="text-fit-dark-gray mt-2">{{ $job_experience->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="my-5">
                        <x-primary-button
                            wire:click="$emit('openModal', 'onboarding.step8.modals.create-job', {{ json_encode(['user' => auth()->id()]) }})"
                            class="w-full max-w-xs justify-center py-3"
                        >
                            Inserisci esperienza
                        </x-primary-button>
                    </div>
                @endif
                @if($currentTab === 'specializations')
                    <div class="px-4 sm:px-0">
                        <h3 class="text-2xl font-semibold leading-7 text-gray-900">Educazione e specializzazioni</h3>
                    </div>
                    <div class="divide-y mt-6">
                        @foreach($specializations as $specialization)
                            <div class="not-prose py-5">
                                <div class="flex items-center justify-between">
                                    <h3 class="text-xl font-bold">{{ $specialization->title }}</h3>
                                    <div class="flex items-center space-x-4">
                                        <svg
                                            wire:click="$emit('openModal', 'onboarding.step9.modals.edit-specialization', {{ json_encode(['specialization' => $specialization->id]) }})"
                                            xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                                            stroke-width="1.5" stroke="currentColor"
                                            class="w-4 h-4 cursor-pointer hover:text-fit-purple-blue">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                  d="M16.862 4.487l1.687-1.688a1.875 1.875 0 112.652 2.652L6.832 19.82a4.5 4.5 0 01-1.897 1.13l-2.685.8.8-2.685a4.5 4.5 0 011.13-1.897L16.863 4.487zm0 0L19.5 7.125"/>
                                        </svg>
                                    </div>
                                </div>
                                <div class="mt-2">
                                    <p class="font-bold text-fit-magenta">{{ $specialization->school }}
                                        - {{ $specialization->city }}</p>
                                    <p class="capitalize">{{ \Carbon\Carbon::parse($specialization->start_date)->monthName }} {{ $specialization->start_date->format('Y') }}
                                        - {{ \Carbon\Carbon::parse($specialization->end_date)->monthName }} {{ $specialization->end_date->format('Y') }}</p>
                                    <p class="text-fit-dark-gray mt-2">{{ $specialization->description }}</p>
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="my-5">
                        <x-primary-button
                            wire:click="$emit('openModal', 'onboarding.step9.modals.create-specialization', {{ json_encode(['user' => auth()->id()]) }})"
                            class="w-full max-w-xs justify-center py-3"
                        >
                            Inserisci specializzazione
                        </x-primary-button>
                    </div>
                @endif
                @if($currentTab === 'medias')
                    <div class="px-4 sm:px-0 space-y-8">
                        <div>
                            <div
                                x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                                class="flex flex-col space-y-2"
                            >
                                <div class="flex items-center justify-between">
                                    <h3 class="text-2xl font-semibold leading-7 text-gray-900 my-0">Foto</h3>
                                    <label for="photos"
                                           class="bg-fit-purple-blue border border-transparent text-white hover:bg-fit-purple-blue/90 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 rounded-md text-sm inline-flex items-center px-5 py-1.5 font-bold focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <input type="file" id="photos" multiple accept="image/*" wire:model="photos"
                                               class="sr-only">
                                        <x-heroicon-o-plus class="h-4 w-4"></x-heroicon-o-plus>
                                    </label>
                                </div>
                                <div x-cloak x-show="isUploading"
                                     class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div
                                        class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        :style="`width: ${progress}%`">
                                        <span x-text="`${progress}`"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6">
                                @if($photos)
                                    <ul class="list-disc divide-y list-inside bg-gray-50 p-4 rounded-md ring-1 ring-gray-300 mt-4 mb-4">
                                        @foreach($photos as $photo)
                                            <li>{{ $photo->getClientOriginalName() }}</li>
                                        @endforeach
                                    </ul>
                                    <x-primary-button wire:click="uploadPhotos">Carica</x-primary-button>
                                @endif
                            </div>
                            <div class="grid grid-cols-3 gap-5 mt-4">
                                @forelse($user_photos as $k => $image)
                                    <div wire:key="image-{{ $k }}" class="group relative">
                                        <div wire:click="deleteMedia({{$image->id}})"
                                             class="absolute top-2 right-2 bg-fit-purple-blue p-1.5 cursor-pointer hover:bg-fit-magenta">
                                            <x-heroicon-o-x-mark class="h-5 w-5 text-white"></x-heroicon-o-x-mark>
                                        </div>
                                        <img src="{{ asset($image->path) }}" class="aspect-square">
                                    </div>
                                @empty
                                    <span class="text-sm text-gray-500">Nessuna immagine</span>
                                @endforelse
                            </div>
                        </div>
                        <div>
                            <div
                                x-data="{ isUploading: false, progress: 0 }"
                                x-on:livewire-upload-start="isUploading = true"
                                x-on:livewire-upload-finish="isUploading = false"
                                x-on:livewire-upload-error="isUploading = false"
                                x-on:livewire-upload-progress="progress = $event.detail.progress"
                                class="flex flex-col space-y-2"
                            >
                                <div class="flex items-center justify-between">
                                    <h3 class="text-2xl font-semibold leading-7 text-gray-900 my-0">Video</h3>
                                    <label for="videos"
                                           class="bg-fit-purple-blue border border-transparent text-white hover:bg-fit-purple-blue/90 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 rounded-md text-sm inline-flex items-center px-5 py-1.5 font-bold focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                        <input type="file" id="videos" multiple accept="video/*" wire:model="videos"
                                               class="sr-only">
                                        <x-heroicon-o-plus class="h-4 w-4"></x-heroicon-o-plus>
                                    </label>
                                </div>
                                <div x-cloak x-show="isUploading"
                                     class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                                    <div
                                        class="bg-blue-600 text-xs font-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
                                        :style="`width: ${progress}%`">
                                        <span x-text="`${progress}`"></span>
                                    </div>
                                </div>
                            </div>
                            <div class="mt-6">
                                @if($videos)
                                    <ul class="list-disc list-inside bg-gray-50 p-4 rounded-md ring-1 ring-gray-300 mt-4 mb-4">
                                        @foreach($videos as $video)
                                            <li>{{ $video->getClientOriginalName() }}</li>
                                        @endforeach
                                    </ul>
                                    <x-primary-button wire:click="uploadVideos">Carica</x-primary-button>
                                @endif
                            </div>
                            <div class="grid grid-cols-2 gap-5 mt-4">
                                @forelse($user_videos as $k => $video)
                                    <div wire:key="video-{{ $k }}" class="group relative">
                                        <div wire:click="deleteMedia({{$video->id}})"
                                             class="absolute z-10 top-2 right-2 bg-fit-purple-blue p-1.5 cursor-pointer hover:bg-fit-magenta">
                                            <x-heroicon-o-x-mark class="h-5 w-5 text-white"></x-heroicon-o-x-mark>
                                        </div>
                                        <video src="{{ asset($video->path) }}" controls class="aspect-video"></video>
                                    </div>
                                @empty
                                    <span class="text-sm text-gray-500">Nessun video</span>
                                @endforelse
                            </div>
                        </div>
                    </div>
                @endif
                @if($currentTab === 'fitness_categories')
                    <div class="px-4 sm:px-0">
                        <h3 class="text-2xl font-semibold leading-7 text-gray-900">Categorie fitness</h3>
                    </div>
                    <div class="mt-6">
                        <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
                            @foreach($categories as $category)
                                <div
                                    wire:click="toggleCategory({{ $category->id }})"
                                    class="{{ in_array($category->id, $selectedCategories) ? 'bg-fit-magenta ring-fit-magenta text-white font-bold' : 'text-fit-purple-blue ring-fit-purple-blue' }} flex items-center justify-center rounded-full px-2 py-2 text-sm ring-2 ring-inset cursor-pointer">
                                    {{ $category->title }}
                                </div>
                            @endforeach
                        </div>
                        <x-input-error :messages="$errors->get('selectedCategories')"></x-input-error>
                        <div class="flex items-center space-x-10 mt-10">
                            <x-primary-button
                                wire:click="updateCategories"
                                :disabled="count($selectedCategories) <= 0"
                                class="w-full max-w-xs justify-center py-3"
                            >
                                Salva
                            </x-primary-button>
                        </div>
                    </div>
                @endif
                @if($currentTab === 'account')
                    <div class="px-4 sm:px-0">
                        <h3 class="text-2xl font-semibold leading-7 text-gray-900">Stripe</h3>
                    </div>
                    <div class="mt-6">
                        @if(!auth()->user()->stripe_account_id)
                            <x-primary-button
                                href="https://connect.stripe.com/oauth/authorize?response_type=code&client_id={{env('STRIPE_CLIENT_ID')}}&scope=read_write">
                                Accedi con Stripe
                            </x-primary-button>
                        @else
                            <div class="flex items-center space-x-5">
                                <span
                                    class="bg-gray-200 ring-1 ring-gray-300 px-4 py-1 rounded-md
                                     text-sm font-semibold font-mono">{{ auth()->user()->stripe_account_id }}</span>
                                <span wire:click="stripeLogout"
                                      class="text-xs font-semibold text-red-500 cursor-pointer">Esci</span>
                            </div>
                        @endif
                    </div>

                    <div class="px-4 sm:px-0 mt-6">
                        <h3 class="text-2xl font-semibold leading-7 text-gray-900">Account</h3>
                    </div>
                    <div class="mt-6">
                        <h2 class="text-lg font-medium text-gray-900">
                            Aggiorna password
                        </h2>

                        <p class="mt-1 text-sm text-gray-600">
                            Assicuratevi che il vostro account utilizzi una password lunga e casuale per rimanere al
                            sicuro.
                        </p>
                        <form wire:submit.prevent="updatePassword" class="mt-6 space-y-6">
                            <div>
                                <x-input-label for="current_password" value="Password attuale"/>
                                <x-text-input wire:model.defer="current_password" id="current_password"
                                              name="current_password" type="password" class="mt-1 block w-full"
                                              autocomplete="current-password"/>
                                <x-input-error :messages="$errors->get('current_password')"
                                               class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="password" value="Nuova password"/>
                                <x-text-input wire:model.defer="password" id="password" name="password" type="password"
                                              class="mt-1 block w-full"
                                              autocomplete="new-password"/>
                                <x-input-error :messages="$errors->get('password')" class="mt-2"/>
                            </div>

                            <div>
                                <x-input-label for="password_confirmation" value="Conferma password"/>
                                <x-text-input wire:model.defer="password_confirmation" id="password_confirmation"
                                              name="password_confirmation" type="password"
                                              class="mt-1 block w-full" autocomplete="new-password"/>
                                <x-input-error :messages="$errors->get('password_confirmation')"
                                               class="mt-2"/>
                            </div>

                            <div class="flex items-center gap-4">
                                <x-primary-button class="w-full max-w-xs justify-center py-3">
                                    Aggiorna
                                </x-primary-button>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
    </main>
</div>
