<?php

namespace App\Http\Livewire;

use Livewire\Component;

class TinyMce extends Component
{
    public $message;
    public function render()
    {
        return view('livewire.tiny-mce');
    }
}
