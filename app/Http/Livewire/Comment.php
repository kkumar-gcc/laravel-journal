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
    public $body;
    // public $editbody;
    public $comment_id;
    protected $listeners = ['edited'];

    public function edited()
    {
        $this->render();
    }
    public function childReply($body,$comment_id){
        $this->replyIndex($comment_id);
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
    public function showModal()
    {
        return view('livewire.edit-comment');
    }
    public function comment()
    {
        if ($this->canComment) {
            ModelsComment::create([
                'body' =>  $this->body,
                'blog_id' => $this->blog_id,
                'user_id' => auth()->id()
            ]);
            $this->reset('body');
            $this->comments_count++;
            $this->body = '';
        }
    }
    public function edit($comment_id)
    {
        $comment = ModelsComment::find($comment_id);
        $this->authorize('update', $comment);
        $this->body = $comment->body();
        $this->comment_id = $comment_id;
        $this->emit('commentEdit',$this->body,$this->comment_id);
    }
    public function replyIndex($comment_id){
        $this->reset('body');
        // dd($this->body,$comment_id);
        $this->comment_id = $comment_id;
        $this->emit('reply',$this->body,$this->comment_id);
    }
    public function update($comment_id)
    {
        $comment = ModelsComment::find($comment_id);
        $this->authorize('update', $comment);
        $comment->update(['body' => $this->body ]);
        $this->reset('body');
        $this->body='';
        $this->emit('editorClose','destroyEditor');
    }
    public function reply($comment_id)
    {
        ModelsReply::create([
            'body' =>  $this->body,
            'comment_id' => $comment_id,
            'user_id' => auth()->id()
        ]);
        $this->reset('body');
        // $this->emit('editorClose','destroyEditor');
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
