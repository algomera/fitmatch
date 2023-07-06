<?php

namespace App\Http\Livewire\Onboarding;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Step10 extends Component
{
    use WithFileUploads;

    public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
    public $images = [];

    protected $listeners = [
        'media-created' => '$refresh',
        'media-deleted' => '$refresh'
    ];

    protected $rules = [
        'images.*' => 'image|max:2048'
    ];

    public function delete($k) {
        unset($this->images[$k]);
    }

    public function mount()
    {
        if(auth()->user()->onboarding_current_step !== 10) {
            return redirect()->route("onboarding.step-" . auth()->user()->onboarding_current_step);
        }
    }

    public function next()
    {
        $this->validate();
        // Salvo immagini
        foreach ($this->images as $image) {
            $filename = $image->getClientOriginalName();
            $ext = substr(strrchr($filename, '.'), 1);
            $path = Storage::disk('public')->putFileAs('user/' . auth()->id() .'/images', $image, Str::uuid() . '.' . $ext);
            auth()->user()->medias()->create([
                'type' => 'image',
                'path' => $path,
            ]);
        }
        auth()->user()->increment('onboarding_current_step');
        return redirect()->route('onboarding.step-11');
    }

    public function render()
    {
        return view('livewire.onboarding.step10')->layout('layouts.onboarding');
    }
}
