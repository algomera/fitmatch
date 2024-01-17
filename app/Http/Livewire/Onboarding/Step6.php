<?php

    namespace App\Http\Livewire\Onboarding;

    use Illuminate\Support\Facades\Storage;
    use Illuminate\Support\Str;
    use Livewire\Component;
    use Livewire\WithFileUploads;

    class Step6 extends Component
    {
        use WithFileUploads;

        public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
        public $profile_image;
        public $user_informations;

        protected $rules = [
            'profile_image' => 'image|max:1024',
            'user_informations.profile_image' => 'nullable',
            'user_informations.bio' => 'nullable',
        ];

        public function mount()
        {
            if(auth()->user()->onboarding_current_step !== 6) {
                return redirect()->route("onboarding.step-" . auth()->user()->onboarding_current_step);
            }
            $this->user_informations = auth()->user()->informations;
        }

        public function next()
        {
            $this->validate();
            $filename = $this->profile_image->getClientOriginalName();
            $ext = substr(strrchr($filename, '.'), 1);
            $path = Storage::disk('public')->putFileAs('user/' . auth()->id() . '/profile_image', $this->profile_image, Str::uuid() . '.' . $ext);
            auth()->user()->informations()->update([
                'profile_image' => $path,
                'bio' => $this->user_informations->bio,
            ]);
            auth()->user()->increment('onboarding_current_step');
            return redirect()->route('onboarding.step-7');
        }

        public function render()
        {
            return view('livewire.onboarding.step6')->layout('layouts.onboarding');
        }
    }
