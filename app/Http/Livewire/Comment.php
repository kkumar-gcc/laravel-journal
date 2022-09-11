<?php

namespace App\Http\Livewire;

use App\Models\Comment as ModelsComment;
use App\Models\Reply as ModelsReply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class Comment extends Component
{
    use WithPagination;
    use AuthorizesRequests;
    public $comments_count;
    public $blog_id;
    public $canComment;
    public $message;
    protected $listeners = ['edited'];

    public function edited()
    {
        $this->render();
    }
    public function mount($blog_id, $canComment, $comments_count)
    {
        $this->blog_id = $blog_id;
        $this->canComment = $canComment;
        $this->comments_count = $comments_count;
    }
    public function render()
    {

        return view('livewire.comment', [
            "comments" => ModelsComment::where("blog_id", "=", $this->blog_id)->latest()->paginate(5)->fragment('comments'),
            "comments_count" => $this->comments_count
        ]);
    }
    public function comment()
    {
        if ($this->canComment) {
            ModelsComment::create([
                'body' =>  $this->message,
                'blog_id' => $this->blog_id,
                'user_id' => auth()->id()
            ]);
            $this->reset('message');
            $this->comments_count++;
        }
    }
    public function reply($comment_id)
    {
        ModelsReply::create([
            'body' =>  $this->message,
            'comment_id' => $comment_id,
            'user_id' => auth()->id()
        ]);
        $this->reset('message');
    }

    public function delete($comment_id)
    {
        $comment = ModelsComment::find($comment_id);
        $this->authorize('delete', $comment);
        if ($comment->replies->count() > 0) {
            dd("you can't delete it completely");
        } else {
            $comment->delete();
            $this->comments_count--;
        }
    }
}
