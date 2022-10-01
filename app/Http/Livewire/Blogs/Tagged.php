<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Tagged extends Component
{
    use WithPagination;
    public $tag;
    public $tab = 'recent';

    protected $queryString = [
        'tab' => ['except' => 'recent']
    ];
    public function mount($tag)
    {
        $this->tag = $tag;
    }
    public function render()
    {
        if ($this->validSort($this->tab)) {
            $blogs = Blog::published()->whereHas('tags', function ($q) {
                $q->where('title', $this->tag);
            })->{$this->tab}()->paginate(10);
        } else {
            $this->tab = 'recent';
            $blogs = Blog::published()->whereHas('tags', function ($q) {
                $q->where('title', $this->tag);
            })->{$this->tab}()->paginate(10);
        }

        return view('livewire.blogs.tagged')->with(["blogs" => $blogs, "tab" => $this->tab]);
    }
    public function sortBy($sort): void
    {
        $this->tab = $this->validSort($sort) ? $sort : 'recent';
    }
    public function validSort($sort): bool
    {
        return in_array($sort, [
            'recent',
            'popular',
            'view'
        ]);
    }
}
