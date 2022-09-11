<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    public $tab = 'recent';

    protected $queryString = [
        'tab' => ['except' => 'recent']
    ];

    public function render()
    {
        if ($this->validSort($this->tab)) {
            $blogs = Blog::published()->{$this->tab}()->paginate(10);
        } else {
            $this->tab = 'recent';
            $blogs = Blog::published()->{$this->tab}()->paginate(10);
        }

        return view('livewire.blog.index')->with(["blogs" => $blogs, "tab" => $this->tab]);
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
