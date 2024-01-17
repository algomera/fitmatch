<div>
    @if($type === 'image')
        <img src="{{ asset($src) }}" class="aspect-square" alt="">
    @endif
    @if($type === 'video')
            <video class="aspect-video" controls>
                <source src="{{ asset($src) }}" type="video/mp4">
            </video>
    @endif
</div>
