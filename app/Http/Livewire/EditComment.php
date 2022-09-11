<?php

namespace App\Http\Livewire;

use App\Models\Comment;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditComment extends Component
{

    use AuthorizesRequests;
    public $comment_id;
    public $message;
    public function mount($comment_id,$message)
    {
        $this->comment_id = $comment_id;
        $this->message=$message;
    }
    public function render()
    {
        return view('livewire.edit-comment');
    }
    public function update()
    {
        $comment = Comment::find($this->comment_id);
        $this->authorize('update', $comment);
        $comment->update(['body' => $this->message]);
        $this->emit('edited');
    }
}
