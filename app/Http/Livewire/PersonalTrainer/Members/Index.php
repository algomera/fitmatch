<?php

namespace App\Http\Livewire\PersonalTrainer\Members;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;

    public $search = '';
    public $status = null;
    public $role = null;

    public function render()
    {
        $members = User::whereHas('informations', function ($q) {
            $q->where('first_name', 'like', '%'.$this->search.'%')->orWhere('last_name', 'like', '%'.$this->search.'%');
        })->whereNotIn('id', User::role([
            'admin'
        ])->get()->pluck('id')->toArray());

        if ($this->status != '') {
            $members = $members->where('status', $this->status);
        }

        if ($this->role != '') {
            $members = $members->role($this->role);
        }

        return view('livewire.personal-trainer.members.index', [
            'members' => $members->paginate(25)
        ]);
    }
}
