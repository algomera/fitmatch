<div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
    <div class="space-y-5">
        <div>
            <h3 class="text-fit-purple-blue">Immagini</h3>
            <div class="grid grid-cols-2 sm:grid-cols-2 gap-6 mt-5">
                @foreach($images as $image)
                    <div class="col-span-1 cursor-pointer">
                        <img wire:click="$emit('openModal', 'components.lightbox', {{ json_encode(['type' => 'image', 'src' => $image->path]) }})" src="{{ asset($image->path) }}" class="aspect-square">
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <div class="space-y-5">
        <div>
            <h3 class="text-fit-purple-blue">Video</h3>
            <div class="grid grid-cols-1 gap-4 mt-5">
                @foreach($videos as $video)
                    <div class="col-span-1 cursor-pointer">
                        <video class="aspect-video" wire:click="$emit('openModal', 'components.lightbox', {{ json_encode(['type' => 'video', 'src' => $video->path]) }})">
                            <source src="{{ asset($video->path) }}" type="video/mp4">
                        </video>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
