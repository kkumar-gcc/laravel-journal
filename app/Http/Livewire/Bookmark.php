<?php

namespace App\Http\Livewire;

use App\Models\Bookmark as ModelsBookmark;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Bookmark extends Component
{
    public $blog_id;
    public $bookmarked = false;
    public $message ='';
    public function mount($blog_id)
    {
        $this->blog_id = $blog_id;
        if (Auth::check()) {
            if (auth()->user()->bookmarks()->where('blog_id', $this->blog_id)->count() > 0) {
                $this->bookmarked = true;
            }
        }
    }
    public function render()
    {
        return view('livewire.bookmark');
    }
    public function bookmark()
    {
        if (Auth::check()) {
            if (auth()->user()->bookmarks()->where('blog_id', $this->blog_id)->count() > 0) {
                auth()->user()->bookmarks()->where('blog_id', $this->blog_id)->delete();
                $this->bookmarked = false;
                $this->message = "removed from bookmarks";
            } else {
                $saved = ModelsBookmark::create([
                    'blog_id' => $this->blog_id,
                    "user_id" => auth()->id()
                ]);
                if ($saved) {
                    $this->bookmarked = true;
                    $this->message = "added in bookmarks";
                }
            }
            $this->emit('changed');
            return;
        }
    }
}
