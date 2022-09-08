<?php

namespace App\Http\Livewire;

use App\Models\Blog;
use Livewire\Component;

class TopBlogs extends Component
{
    public $blogs;
    public function mount()
    {
        $this->blogs =Blog::select(['id', 'title', 'created_at'])->where("status", "=", "posted")->withCount('blogviews')->orderByDesc('blogviews_count')->limit(5)->get();
    }
    public function render()
    {
        return view('livewire.top-blogs',["topBlogs"=>$this->blogs]);
    }
}
