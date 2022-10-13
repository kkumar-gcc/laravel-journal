<?php

namespace App\Http\Livewire\Blogs;

use App\Models\Blog;
use App\Models\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Cviebrock\EloquentSluggable\Services\SlugService;
class Update extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;
    public $title;
    public $body;
    public $blog;
    public $message;
    public $coverImage;
    public $tags = [];
    public $search;
    protected $rules = [
        'coverImage' => ['required', 'mimes:png,jpg,svg,gif', 'max:2048'],
        'title' => ['required', 'max:200', 'min:20'],
        'body' => ['required', 'min:20'],
        'tags' => ['required', 'array', 'min:1', 'max:5']
    ];
    public function mount(Blog $blog)
    {
        $this->blog = $blog;
        $this->title = $blog->title();
        $this->body = $blog->body();
        foreach ($blog->tags as $tag) {
            $this->tags[] = $tag->title;
        };
    }
    public function render()
    {
        $this->authorize('view', $this->blog);
        if ($this->search != NULL) {
            $this->searchTags = Tag::query()->where('title', 'LIKE', '%'.$this->search.'%')->take(5)->get();
        }else{
            $this->searchTags=[];
        }
        return view('livewire.blogs.update');

    }
    public function update()
    {
        $this->authorize('update', $this->blog);
        $this->validate();
        $this->blog->update([
            'title' => $this->title,
            'body' => $this->body,
            'cover_image'=> $this->coverImage->store('/','images')
        ]);
        $tagIds = [];
        foreach ($this->tags as $tag) {
            $tag = Tag::firstOrCreate(['title' => $tag]);
            if ($tag) {
                $tagIds[] = $tag->id;
            }
        };
        $this->blog->tags()->sync($tagIds);
        return redirect()->to('/blogs/'.$this->blog->slug);
    }
}
