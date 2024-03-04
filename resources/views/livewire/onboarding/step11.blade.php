<div>
    <div class="prose prose-sm mx-auto">
        <div>
            <h1 class="pt-14 mb-2">Categorie</h1>
        </div>
        <div class="mt-6">
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-5">
                @foreach($categories as $category)
                    <div
                        wire:click="toggleCategory({{ $category->id }})"
                        class="{{ in_array($category->id, $selectedCategories) ? 'bg-fit-magenta ring-fit-magenta text-white font-fit-bold' : 'text-fit-purple-blue ring-fit-purple-blue' }} flex items-center justify-center rounded-full px-2 py-2 text-sm ring-2 ring-inset cursor-pointer">
                        {{ $category->title }}
                    </div>
                @endforeach
            </div>
            <div class="flex items-center space-x-10 mt-10">
                <x-primary-button wire:click="next" :disabled="count($selectedCategories) <= 0">
                    Avanti
                </x-primary-button>
            </div>
        </div>
    </div>
</div>
<x-slot:image>
    <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
         src="{{$image}}" alt="">
</x-slot:image>
