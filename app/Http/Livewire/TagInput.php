<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TagInput extends Component
{
    public $tags = [];
    public function render()
    {
        return view('livewire.tag-input');
    }
}
