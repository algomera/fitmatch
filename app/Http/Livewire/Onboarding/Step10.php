<?php

namespace App\Http\Livewire\Onboarding;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Step10 extends Component
{
    use WithFileUploads;

    public $image = 'https://photos.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
    public $photos = [];
    public $videos = [];

    //    protected $listeners = [
    //        'media-created' => '$refresh',
    //        'media-deleted' => '$refresh'
    //    ];

    //    protected $rules = [
    //        'photos.*' => 'image|max:2048',
    //        'videos.*' => 'mimes:mp4,mov|max:5120'
    //    ];

    public function deleteImage($k)
    {
        unset($this->photos[$k]);
    }

    public function deleteVideo($k)
    {
        unset($this->videos[$k]);
    }

    public function mount()
    {
        if (auth()->user()->onboarding_current_step !== 10) {
            return redirect()->route("onboarding.step-".auth()->user()->onboarding_current_step);
        }
    }

    public function uploadPhotos()
    {
        foreach ($this->photos as $photo) {
            $filename = $photo->getClientOriginalName();
            $ext = substr(strrchr($filename, '.'), 1);
            $path = Storage::disk('public')->putFileAs('user/'.auth()->id().'/images', $photo, Str::uuid().'.'.$ext);
            auth()->user()->medias()->create([
                'type' => 'image',
                'path' => $path,
            ]);
        }
        $this->reset("photos");
    }

    public function uploadVideos()
    {
        foreach ($this->videos as $videos) {
            $filename = $videos->getClientOriginalName();
            $ext = substr(strrchr($filename, '.'), 1);
            $path = Storage::disk('public')->putFileAs('user/'.auth()->id().'/images', $videos, Str::uuid().'.'.$ext);
            auth()->user()->medias()->create([
                'type' => 'video',
                'path' => $path,
            ]);
        }
        $this->reset("videos");
    }

    public function deleteMedia($k)
    {
        auth()->user()->medias()->find($k)->delete();
    }

    public function next()
    {
        //        $this->validate();
        //        foreach ($this->photos as $image) {
        //            $filename = $image->getClientOriginalName();
        //            $ext = substr(strrchr($filename, '.'), 1);
        //            $path = Storage::disk('public')->putFileAs('user/'.auth()->id().'/photos', $image, Str::uuid().'.'.$ext);
        //            auth()->user()->medias()->create([
        //                'type' => 'image',
        //                'path' => $path,
        //            ]);
        //        }
        //        foreach ($this->videos as $video) {
        //            $filename = $video->getClientOriginalName();
        //            $ext = substr(strrchr($filename, '.'), 1);
        //            $path = Storage::disk('public')->putFileAs('user/'.auth()->id().'/videos', $video, Str::uuid().'.'.$ext);
        //            auth()->user()->medias()->create([
        //                'type' => 'video',
        //                'path' => $path,
        //            ]);
        //        }
        auth()->user()->increment('onboarding_current_step');
        return redirect()->route('onboarding.step-11');
    }

    public function render()
    {
        return view('livewire.onboarding.step10', [
            'user_photos' => auth()->user()->medias()->where('type', 'image')->get(),
            'user_videos' => auth()->user()->medias()->where('type', 'video')->get(),
        ])->layout('layouts.onboarding');
    }
}
