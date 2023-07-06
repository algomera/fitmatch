<div>
    <div class="prose prose-sm mx-auto">
        <div>
            <h1 class="pt-14 mb-2">Immagine del profilo</h1>
            <span>La tua immagine del profilo. L'immagine sarà visibile agli atleti, scegline una che ti rappresenta al meglio!</span>
        </div>
        <div class="mt-6">
            <div>
                <form class="flex items-center space-x-6">
                    @if($user_informations->profile_image && !$profile_image)
                        <div class="shrink-0">
                            <img class="h-48 w-48 object-cover rounded-sm"
                                 src="{{ asset('/'.$user_informations->profile_image) }}"/>
                        </div>
                    @endif
                    @if($profile_image)
                        <div class="shrink-0">
                            <img class="h-48 w-48 object-cover rounded-sm" src="{{ $profile_image->temporaryUrl() }}"/>
                        </div>
                    @endif
                    <label class="block">
                        <span class="sr-only">Choose profile photo</span>
                        <input wire:model="profile_image" type="file" class="block w-full text-sm text-slate-500
                          file:mr-4 file:py-2 file:px-4
                          file:rounded-full file:border-0
                          file:text-sm file:font-semibold
                          file:bg-fit-purple-blue file:text-white
                          hover:file:bg-fit-magenta
                        "/>
                    </label>
                </form>
                <x-input-error :messages="$errors->get('profile_image')" class="mt-2"/>
            </div>
        </div>
        <div class="mt-6">
            <h1 class="mb-2">Biografia</h1>
            <span>Raccontaci qualcosa di te e della tua esperienza.</span>
            <div class="mt-10 grid grid-cols-1 gap-5">
                <div class="col-span-1">
                    <x-textarea wire:model="user_informations.bio" id="bio"
                                rows="6"
                                name="user_informations.bio"/>
                </div>
            </div>
        </div>
        <div class="not-prose mt-10">
            <x-primary-button wire:click="next" class="!px-14">Avanti</x-primary-button>
        </div>
    </div>
</div>
<x-slot:image>
    <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
         src="{{$image}}" alt="">
</x-slot:image>
