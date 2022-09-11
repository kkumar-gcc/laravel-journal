<?php

namespace App\Http\Livewire\Blog;

use App\Models\Blog;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Str;
class Create extends Component
{
    use WithFileUploads;

    public $title;

    public $body = "# hello peoples";

    public $message;

    public $photo;

    protected $rules = [
        // 'cover_image' => ['required', 'mimes:png,jpg,svg,gif', 'max:2048'],
        'title' => ['required', 'max:200', 'min:20'],
        'body' => ['required', 'min:20'],

    ];

    public function render()
    {
        return view('livewire.blog.create');
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
            'title'=>$this->title,
            'body'=>$this->body,
            'user_id'=>auth()->id()
         ]);
        return redirect()->to('/blogs/'.Str::slug($this->title, '-').'-'.$blog->id);
    }
}
