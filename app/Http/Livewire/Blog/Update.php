<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
class Update extends Component
{
    use WithFileUploads;
    use AuthorizesRequests;
    public $title;

    public $body ;
    public $blog;

    public $message;

    public $photo;

    protected $rules = [
        // 'cover_image' => ['required', 'mimes:png,jpg,svg,gif', 'max:2048'],
        'title' => ['required', 'max:200', 'min:20'],
        'body' => ['required', 'min:20'],

    ];
    public function mount(Blog $blog){
        $this->blog=$blog;
        $this->title=$blog->title();
        $this->body=$blog->body();
    }
    public function render()
    {
        $this->authorize('view', $this->blog);
        return view('livewire.blog.update');
    }
    public function update()

    {
        $this->authorize('update', $this->blog);
        $this->validate();
        $blog = Blog::create([
            'title'=>$this->title,
            'body'=>$this->body,
            'user_id'=>auth()->id()
         ]);
        return redirect()->to('/blogs/'.Str::slug($this->title, '-').'-'.$blog->id);
    }
}
