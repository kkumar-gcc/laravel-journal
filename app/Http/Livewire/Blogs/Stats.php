<?php

namespace App\Http\Livewire\Blogs;

use Livewire\Component;

class Stats extends Component
{
    public $tab="stats";
    public $blog;
    public function mount($blog)
    {
        $this->blog=$blog;
    }
    public function render()
    {
        return view('livewire.blogs.stats');
    }
}
