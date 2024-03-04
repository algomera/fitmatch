<div>
    <div class="prose prose-sm mx-auto">
        <div class="flex items-center justify-between">
            <h1>Immagini e video</h1>
            @if(count($user_photos) > 0)
                <x-primary-button wire:click="next">Avanti</x-primary-button>
            @endif
        </div>
        <div class="mt-6">
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
                                   class="bg-fit-purple-blue border border-transparent text-white hover:bg-fit-purple-blue/90 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 rounded-md text-sm inline-flex items-center px-5 py-1.5 font-fit-bold focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                <input type="file" id="photos" multiple accept="image/*" wire:model="photos"
                                       class="sr-only">
                                <x-heroicon-o-plus class="h-4 w-4"></x-heroicon-o-plus>
                            </label>
                        </div>
                        <div x-cloak x-show="isUploading"
                             class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                            <div
                                class="bg-blue-600 text-xs font-fit-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
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
                            Nessuna immagine
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
                                   class="bg-fit-purple-blue border border-transparent text-white hover:bg-fit-purple-blue/90 focus:bg-gray-700 active:bg-gray-900 focus:ring-indigo-500 rounded-md text-sm inline-flex items-center px-5 py-1.5 font-fit-bold focus:outline-none focus:ring-2 focus:ring-offset-2 transition ease-in-out duration-150 disabled:opacity-50 disabled:cursor-not-allowed">
                                <input type="file" id="videos" multiple accept="video/*" wire:model="videos"
                                       class="sr-only">
                                <x-heroicon-o-plus class="h-4 w-4"></x-heroicon-o-plus>
                            </label>
                        </div>
                        <div x-cloak x-show="isUploading"
                             class="w-full bg-gray-200 rounded-full dark:bg-gray-700">
                            <div
                                class="bg-blue-600 text-xs font-fit-medium text-blue-100 text-center p-0.5 leading-none rounded-full"
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
                            Nessun video
                        @endforelse
                    </div>
                </div>
            </div>

            {{--            <div class="grid grid-cols-3 gap-5">--}}
            {{--                @foreach($images as $k => $image)--}}
            {{--                    <div wire:key="image-{{ $k }}" class="group relative">--}}
            {{--                        <div wire:click="deleteImage({{$k}})" class="absolute top-8 right-2 bg-fit-purple-blue p-1.5 cursor-pointer hover:bg-fit-magenta">--}}
            {{--                            <x-heroicon-o-x-mark class="h-5 w-5 text-white"></x-heroicon-o-x-mark>--}}
            {{--                        </div>--}}
            {{--                        <img src="{{ $image->temporaryUrl() }}" class="aspect-square">--}}
            {{--                    </div>--}}
            {{--                @endforeach--}}
            {{--                    @foreach($videos as $k => $video)--}}
            {{--                        <div wire:key="video-{{ $k }}" class="group relative">--}}
            {{--                            <div wire:click="deleteVideo({{$k}})" class="absolute top-8 right-2 bg-fit-purple-blue p-1.5 cursor-pointer hover:bg-fit-magenta">--}}
            {{--                                <x-heroicon-o-x-mark class="h-5 w-5 text-white"></x-heroicon-o-x-mark>--}}
            {{--                            </div>--}}
            {{--                            <img src="https://placehold.co/193x193" class="aspect-square">--}}
            {{--                        </div>--}}
            {{--                    @endforeach--}}
            {{--            </div>--}}
            {{--            <div class="flex items-center space-x-5 mt-10">--}}
            {{--                <div>--}}
            {{--                    <label for="images"--}}
            {{--                           class="text-sm inline-flex items-center px-5 py-1.5 bg-fit-purple-blue border border-transparent rounded-md font-semibold text-white tracking-widest cursor-pointer hover:bg-fit-magenta focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">--}}
            {{--                        Aggiungi immagine--}}
            {{--                    </label>--}}
            {{--                    <input type="file" class="hidden" id="images" name="images" wire:model="images">--}}
            {{--                </div>--}}
            {{--                <div>--}}
            {{--                    <label for="videos"--}}
            {{--                           class="text-sm inline-flex items-center px-5 py-1.5 bg-fit-purple-blue border border-transparent rounded-md font-semibold text-white tracking-widest cursor-pointer hover:bg-fit-magenta focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">--}}
            {{--                        Aggiungi video--}}
            {{--                    </label>--}}
            {{--                    <input type="file" class="hidden" id="videos" name="videos" wire:model="videos">--}}
            {{--                </div>--}}
            {{--                @if(count($images) > 0)--}}
            {{--                    <x-primary-button wire:click="next">Avanti</x-primary-button>--}}
            {{--                @endif--}}
            {{--            </div>--}}
        </div>
    </div>
</div>
<x-slot:image>
    <img class="aspect-[3/2] w-full bg-gray-50 object-cover lg:absolute lg:inset-0 lg:aspect-auto lg:h-full"
         src="{{$image}}" alt="">
</x-slot:image>
