<?php

namespace App\Http\Livewire\Blogs;

use App\Events\BlogWasCreated;
use App\Models\Blog;
use App\Models\Tag;
use Livewire\Component;
use Livewire\WithFileUploads;
use Cviebrock\EloquentSluggable\Services\SlugService;
class Create extends Component
{
    use WithFileUploads;
    public $title;
    public $body;
    public $message;
    public $photo;
    public $tags = [];
    public $search;
    public $searchTags=[];
    protected $rules = [
        // 'cover_image' => ['required', 'mimes:png,jpg,svg,gif', 'max:2048'],
        'title' => ['required', 'max:200', 'min:20'],
        'body' => ['required', 'min:20'],
        'tags' => ['required', 'array', 'min:1', 'max:5']
    ];
    public function render()
    {
        if ($this->search != NULL) {
            $this->searchTags = Tag::query()->where('title', 'LIKE', '%'.$this->search.'%')->take(5)->get();
        }else{
            $this->searchTags=[];
        }
        return view('livewire.blogs.create');
    }

    public function updatedPhoto()
    {
        $this->validate([
            'photo' => 'image|max:1024', // 1MB Max
        ]);
    }
    public function submit()
    {
        $this->validate();
        $blog = Blog::create([
            'title' => $this->title,
            'body' => $this->body,
            'user_id' => auth()->id()
        ]);
        $tagIds = [];
        foreach ($this->tags as $tag) {
            $tag = Tag::firstOrCreate(['title' => $tag]);
            if ($tag) {
                $tagIds[] = $tag->id;
            }
        };
        $blog->tags()->sync($tagIds);
        BlogWasCreated::dispatch($blog);
        return redirect()->to('/blogs/'.$blog->slug);
    }
    public function draft()
    {
        $this->validate();
        $blog = Blog::create([
            'title' => $this->title,
            'body' => $this->body,
            'status' => "drafted",
            'user_id' => auth()->id()
        ]);
        $tagIds = [];
        foreach ($this->tags as $tag) {
            $tag = Tag::firstOrCreate(['title' => $tag]);
            if ($tag) {
                $tagIds[] = $tag->id;
            }
        };
        $blog->tags()->sync($tagIds);
        $this->emit('changed');
        return redirect()->to('/settings?tab=drafts');
    }
}
