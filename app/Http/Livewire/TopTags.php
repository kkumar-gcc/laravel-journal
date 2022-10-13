<?php

namespace App\Http\Livewire;

use App\Models\Tag;
use Livewire\Component;

class TopTags extends Component
{
    public $tags;
    public function mount()
    {
        $this->tags = Tag::select(['id','title','color'])->withCount(['blogs' => function ($q) {
            $q->published();
        }])->orderByDesc('blogs_count')->limit(10)->get();
    }
    public function render()
    {
        return view('livewire.top-tags',["topTags"=>$this->tags]);
    }
}
