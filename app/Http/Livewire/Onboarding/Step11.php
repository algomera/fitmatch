<?php

namespace App\Http\Livewire\Onboarding;

use App\Models\Categories;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Livewire\Component;
use Livewire\WithFileUploads;

class Step11 extends Component
{
    use WithFileUploads;

    public $image = 'https://images.unsplash.com/photo-1594381898411-846e7d193883?ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D&auto=format&fit=crop&w=987&q=80';
    public $selectedCategories = [];

    protected $rules = [
        'selectedCategories' => 'min:1'
    ];

    public function mount()
    {
        foreach (auth()->user()->categories as $category) {
            $this->selectedCategories[] = $category->id;
        }
        if (auth()->user()->onboarding_step_11) {
            return redirect()->route('onboarding.step-12');
        }
    }

    public function toggleCategory($id) {
        if(in_array($id, $this->selectedCategories)) {
            $index = array_search($id, $this->selectedCategories);
            unset($this->selectedCategories[$index]);
        } else {
            $this->selectedCategories[] = $id;
        }
    }

    public function next()
    {
        $this->validate();

        auth()->user()->categories()->sync($this->selectedCategories);

        auth()->user()->update([
            'onboarding_step_11' => true
        ]);
        return redirect()->route('onboarding.step-12');
    }

    public function render()
    {
        return view('livewire.onboarding.step11',
            [
                'categories' => Categories::all()
            ])->layout('layouts.onboarding');
    }
}
