<?php

namespace App\Http\Livewire\Blogs;

use App\Gamify\Points\BlogCreated;
use App\Models\Blog;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Manage extends Component
{
    use AuthorizesRequests;
    public $tab = "manage";
    public $blog;
    public $comment_access;
    public $blog_access;
    public $adult_warning;
    public $age_confirmation;
    public function mount(Blog $blog)
    {
        $this->blog = $blog;
        $this->comment_access = $blog->comment_access;
        $this->blog_access = $blog->access;
        $this->adult_warning = $blog->adult_warning;
        $this->age_confirmation = $blog->age_confirmation;
    }
    public function render()
    {
        return view('livewire.blogs.manage');
    }
    // protected $rules = [
    // ];
    public function update()
    {

        $this->authorize('update', $this->blog);
        // $this->validate();
        $this->blog->access = $this->blog_access;
        $this->blog->comment_access = $this->comment_access;
        $this->blog->adult_warning = $this->adult_warning;
        $this->blog->age_confirmation = $this->age_confirmation;
        $saved = $this->blog->save();
        if ($saved) {
            $this->emit('changed');
            session()->flash('message', 'blog updated successfully');
        }
    }
    public function delete()
    {
        $this->authorize('delete', $this->blog);
        undoPoint(new BlogCreated($this->blog));
        $this->blog->delete();
        return redirect()->to('/blogs');
    }
}
