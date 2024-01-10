<?php

namespace App\Http\Livewire\PersonalTrainer\Profile;

use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;

class Edit extends Component
{
    use WithFileUploads;

    public $tabs = [
        'personal_informations' => 'Informazioni personali',
        'company_informations' => 'Informazioni aziendali',
        'job_experiences' => 'Esperienze lavorative',
        'specializations' => 'Specializzazioni',
        'medias' => 'Foto e video',
        'fitness_categories' => 'Categorie fitness',
        'account' => 'Account'
    ];
    public $currentTab = 'personal_informations';
    public $selectedCategories = [];
    public $profile_image;
    public $photos = [];
    public $videos = [];

    public $current_password, $password, $password_confirmation;
    protected $listeners = [
        'job-experience-created' => '$refresh',
        'job-experience-updated' => '$refresh',
        'specialization-created' => '$refresh',
        'specialization-updated' => '$refresh'
    ];

    public function mount()
    {


        foreach (auth()->user()->categories as $category) {
            $this->selectedCategories[] = $category->id;
        }
    }

    public function updatedProfileImage()
    {
        $filename = $this->profile_image->getClientOriginalName();
        $ext = substr(strrchr($filename, '.'), 1);
        $path = Storage::disk('public')->putFileAs('user/'.auth()->id().'/profile_image', $this->profile_image, Str::uuid().'.'.$ext);
        auth()->user()->informations()->update([
            'profile_image' => $path,
        ]);
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

    public function toggleCategory($id)
    {
        if (in_array($id, $this->selectedCategories)) {
            $index = array_search($id, $this->selectedCategories);
            unset($this->selectedCategories[$index]);
        } else {
            $this->selectedCategories[] = $id;
        }
    }

    public function updateCategories()
    {
        $this->validate([
            'selectedCategories' => 'min:1'
        ]);

        auth()->user()->categories()->sync($this->selectedCategories);
        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Categorie aggiornate'),
            'subtitle' => 'Le categorie sono state aggiornate con successo.',
            'type' => 'success',
        ]);
    }

    public function updatePassword()
    {
        $this->validate();

        auth()->user()->update([
            'password' => Hash::make($this->password),
        ]);

        $this->dispatchBrowserEvent('open-notification', [
            'title' => __('Password aggiornata'),
            'subtitle' => 'La password è stata aggiornata con successo.',
            'type' => 'success',
        ]);
        $this->reset(['current_password', 'password', 'password_confirmation']);
    }

    public function render()
    {
        return view('livewire.personal-trainer.profile.edit', [
            'job_experiences' => auth()->user()->job_experiences,
            'specializations' => auth()->user()->specializations,
            'categories' => Category::all(),
            'user_photos' => auth()->user()->medias()->where('type', 'image')->get(),
            'user_videos' => auth()->user()->medias()->where('type', 'video')->get(),
        ]);
    }

    protected function rules()
    {
        return [
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ];
    }
}
