<?php

namespace App\Http\Livewire\Components;

use LivewireUI\Modal\ModalComponent;

class Lightbox extends ModalComponent
{
    public $type, $src;

    public static function modalMaxWidth(): string
    {
        return '4xl';
    }
    public function mount($type, $src) {
        $this->type = $type;
        $this->src = $src;
    }
    public function render()
    {
        return view('livewire.components.lightbox');
    }
}
