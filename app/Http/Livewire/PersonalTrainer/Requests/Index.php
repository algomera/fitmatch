<?php

namespace App\Http\Livewire\PersonalTrainer\Requests;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public function render()
    {
        return view('livewire.personal-trainer.requests.index', [
            'requests' => User::whereNotIn('id', User::role([
                'admin', 'athlete'
            ])->get()->pluck('id')->toArray())->whereNull('status')->paginate(25)
        ]);
    }
}
