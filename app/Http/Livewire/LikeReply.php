<?php

namespace App\Http\Livewire;

use App\Models\ReplyLike;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class LikeReply extends Component
{
    public $reply_id;
    public $isLiked = false;
    public $isDisliked = false;
    public $likes_count;
    public function mount($reply_id, $likes_count)
    {
        $this->reply_id = $reply_id;
        $this->likes_count = $likes_count;
        if (Auth::check()) {
            if (auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', 1]])->count() > 0) {
                $this->isLiked = true;
            }
            if (auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', 0]])->count() > 0) {
                $this->isDisliked = true;
            }
        }
    }
    public function render()
    {
        return view('livewire.like-reply');
    }
    public function like()
    {
        if (Auth::check()) {
            if (auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', '1']])->count() > 0) {
                auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', '1']])->delete();
                $this->isLiked = false;
                $this->isDisliked = false;
                $this->likes_count--;
            } else {
                if (auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', '0']])->count() > 0) {
                    auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', '0']])->update(['status' => 1]);
                    $this->isLiked = true;
                    $this->isDisliked = false;
                    $this->likes_count++;
                } else {
                    $saved = replyLike::create([
                        'reply_id' => $this->reply_id,
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
            if (auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', '0']])->count() > 0) {
                auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', '0']])->delete();
                $this->isDisliked = false;
                $this->isLiked = false;
            } else {
                if (auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', '1']])->count() > 0) {
                    auth()->user()->replylikes()->where([['reply_id', $this->reply_id], ['status', '=', '1']])->update(['status' => 0]);
                    $this->isLiked = false;
                    $this->isDisliked = true;
                    $this->likes_count--;
                } else {
                    $saved = ReplyLike::create([
                        'reply_id' => $this->reply_id,
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
