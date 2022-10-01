<?php

namespace App\Http\Livewire\Profile;

use App\Models\Blog;
use App\Models\BlogPin;
use Livewire\Component;
use Livewire\WithPagination;

class PinBlog extends Component
{
    use WithPagination;
    protected $pins;
    protected $blogs;
    protected $blog_id;
    public $message;
    public $pinned;
    public function render()
    {
        $this->pins = BlogPin::where("user_id", "=", auth()->user()->id)->get();
        $this->blogs = Blog::where("user_id", "=", auth()->user()->id)->where([['status', '=', 'posted'], ["is_pinned", "=", false]])->paginate(5);
        return view('livewire.profile.pin-blog')
            ->with(["pins" => $this->pins, "blogs" => $this->blogs]);
    }
    public function pin($blog_id)
    {
        $this->blog_id=$blog_id;
        $exist = BlogPin::where([
            ["user_id", "=", auth()->id()],
            ["blog_id", "=", $this->blog_id]
        ]);
        // $blog = Blog::find($blog_id);
        if ($exist->count() < 1) {
            BlogPin::create([
                "user_id" => auth()->id(),
                "blog_id" => $this->blog_id,
            ]);
            Blog::where("id", "=", $this->blog_id)->update(['is_pinned' => 1]);
            $this->pinned=true;
            $this->message = 'blog pinned successfully.';
        } else {
            $deleted = $exist->delete();
            Blog::where("id", "=", $this->blog_id)->update(['is_pinned' => 0]);
            if ($deleted) {
                $this->pinned=false;
                $this->message = 'blog unpinned successfully';
            } else {
                $this->pinned=false;
                $this->message = 'something goes wrong.';
            }
        }
        $this->reset('blog_id');
        $this->emit('changed');
    }
}
