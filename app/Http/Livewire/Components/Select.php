<?php

namespace App\Http\Livewire\Components;

use Livewire\Component;

class Select extends Component
{
    public $items;
    //	public $query = null;
    public $selected = null;
    public $event, $to;
    public $title;
    public $title2;
    public $oldTitle;
    public $subtitle;
    public $titleToShow;
    public $subtitleToShow;
    public $searchFields = [];
    public $return, $disabled, $required, $name, $label, $hint, $append = 'heroicon-o-chevron-down', $prepend, $iconColor;

    public function mount($title, $subtitle = null, $items = null)
    {
        $this->items = $items;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->titleToShow = explode('.', $title);
        $this->subtitleToShow = explode('.', $subtitle);
        if ($title) {
            $this->searchFields[] = $title;
        }
        if ($subtitle) {
            $this->searchFields[] = $subtitle;
        }
        if ($this->selected) {
            if (count($this->titleToShow) == 1) {
                $this->oldTitle = $this->items->find($this->selected)?->{$this->title};
            } elseif (count($this->titleToShow) == 2) {
                $relationName = $this->titleToShow[0];
                $relationAttribute = $this->titleToShow[1];
                $this->oldTitle = $this->items->find($this->selected)->{$relationName}->{$relationAttribute};
            }
        }
    }

    public function test($id)
    {
        $item = $this->items->find($id);
        $this->selectItem($this->titleToShow, $item, $this->event, $this->to);
    }

    public function selectItem($title, $item, $event, $to = null)
    {
        $this->selected = $item[$this->return];
        $this->title2 = $title;
        $this->oldTitle = $title;
        $this->emitUp($event, $item[$this->return], $to);
    }

    public function render()
    {
        return view('livewire.components.select');
    }
}
