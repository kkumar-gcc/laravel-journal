<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TagInput extends Component
{
    public $tags = [];
    public $search;
    public function render()
    {
        return view('livewire.tag-input')->with(["searchTags" => Tag::query()->where('title', 'LIKE', $this->search)->take(5)->get()]);
    }
}
