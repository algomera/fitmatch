<?php

namespace App\Http\Livewire\PersonalTrainer\Profile;

use App\Models\Category;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;
use Livewire\WithFileUploads;
use Stripe\Exception\ApiErrorException;
use Stripe\Exception\AuthenticationException;

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
    public $stripe_secret = null;
    protected $queryString = 'currentTab';
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
        $this->stripe_secret = auth()->user()->stripe_secret;
    }

    //    public function stripeLogout()
    //    {
    //        Stripe::setApiKey(env('STRIPE_SECRET'));
    //        OAuth::deauthorize([
    //            'client_id' => env('STRIPE_CLIENT_ID'),
    //            'stripe_user_id' => auth()->user()->stripe_account_id,
    //        ]);
    //        auth()->user()->update([
    //            'stripe_account_id' => null
    //        ]);
    //    }

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
        $this->validate([
            'current_password' => ['required', 'current_password'],
            'password' => ['required', Password::defaults(), 'confirmed'],
        ]);

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

    public function saveStripeSecret()
    {
        $this->validate([
            'stripe_secret' => 'required|string|alpha_dash',
        ]);

        try {
            \Stripe\Stripe::setApiKey($this->stripe_secret);
            $transactions = \Stripe\BalanceTransaction::all(['limit' => 10]);

            auth()->user()->update([
                'stripe_secret' => $this->stripe_secret,
            ]);
            $this->dispatchBrowserEvent('open-notification', [
                'title' => __('Chiave Stripe salvata con successo'),
                'type' => 'success',
            ]);
        } catch (AuthenticationException $e) {
            $this->dispatchBrowserEvent('open-notification', [
                'title' => __('Errore: La chiave segreta non è corretta.'),
                'type' => 'error',
            ]);
        } catch (ApiErrorException $e) {
            $this->dispatchBrowserEvent('open-notification', [
                'title' => __('Errore API: "'.$e->getError()->message."'"),
                'type' => 'error',
            ]);
        }
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
}
