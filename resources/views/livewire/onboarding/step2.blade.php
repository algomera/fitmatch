<div>
    <div class="prose prose-sm mx-auto">
        <h1 class="pt-14 uppercase">Pubblico o privato</h1>
        <p class="mt-6">
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Ad animi at eos minima molestiae quas quidem.
            Corporis praesentium quidem quo reiciendis sit? Accusamus exercitationem harum ipsam nihil officiis quae
            quos!
        </p>
        <div class="mt-6">
            <div class="space-y-4 sm:flex sm:items-center sm:space-x-10 sm:space-y-0">
                <div class="flex items-center">
                    <input wire:model="user_informations.profile_type" id="public" name="profile-type" type="radio" value="public"
                           class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="public" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Richiedi profilo pubblico</label>
                </div>
                <div class="flex items-center">
                    <input wire:model="user_informations.profile_type" id="private" name="profile-type" type="radio" value="private"
                           class="h-4 w-4 border-gray-300 text-indigo-600 focus:ring-indigo-600">
                    <label for="private" class="ml-3 block text-sm font-medium leading-6 text-gray-900">Preferisco solo il profilo privato</label>
                </div>
            </div>
            <x-input-error :messages="$errors->get('user_informations.profile_type')" class="not-prose mt-2" />
        </div>
        <div class="not-prose mt-10">
            <x-primary-button wire:click="next" :disabled="!$user_informations->profile_type">Avanti</x-primary-button>
        </div>
    </div>
</div>
<x-slot:image>
    <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
         src="{{$image}}" alt="">
</x-slot:image>
