<?php

namespace App\Http\Livewire;

use App\Models\BlogLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeBlog extends Component
{
    public $blog_id;
    public $isLiked = false;
    public $isDisliked = false;
    public $likes_count;
    public function mount($blog_id, $likes_count)
    {
        $this->blog_id = $blog_id;
        $this->likes_count = $likes_count;
        if (Auth::check()) {
            if (auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', 1]])->count() > 0) {
                $this->isLiked = true;
            }
            if (auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', 0]])->count() > 0) {
                $this->isDisliked = true;
            }
        }
    }
    public function render()
    {
        return view('livewire.like-blog');
    }
    public function like()
    {
        if (Auth::check()) {
            if (auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', '1']])->count() > 0) {
                auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', '1']])->delete();
                $this->isLiked = false;
                $this->isDisliked = false;
                $this->likes_count--;
            } else {
                if (auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', '0']])->count() > 0) {
                    auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', '0']])->update(['status' => 1]);
                    $this->isLiked = true;
                    $this->isDisliked = false;
                    $this->likes_count++;
                } else {
                    $saved = BlogLike::create([
                        'blog_id' => $this->blog_id,
                        "user_id" => auth()->id(),
                        "status" => 1
                    ]);
                    if ($saved) {
                        $this->isLiked = true;
                        $this->isDisliked = false;
                        $this->likes_count++;
                    }
                }
            }
            if($this->likes_count<0){
                $this->likes_count=0;
            }
        }
    }
    public function dislike()
    {
        if (Auth::check()) {
            if (auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', '0']])->count() > 0) {
                auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', '0']])->delete();
                $this->isDisliked = false;
                $this->isLiked = false;
            } else {
                if (auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', '1']])->count() > 0) {
                    auth()->user()->bloglikes()->where([['blog_id', $this->blog_id], ['status', '=', '1']])->update(['status' => 0]);
                    $this->isLiked = false;
                    $this->isDisliked = true;
                    $this->likes_count--;
                } else {
                    $saved = BlogLike::create([
                        'blog_id' => $this->blog_id,
                        "user_id" => auth()->id(),
                        "status" => 0
                    ]);
                    if ($saved) {
                        $this->isLiked = false;
                        $this->isDisliked = true;
                    }
                }
            }
            if($this->likes_count<0){
                $this->likes_count=0;
            }
        }
    }
}
