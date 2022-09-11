<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditReply extends Component
{
    use AuthorizesRequests;
    public $reply_id;
    public $body;
    public function mount($reply_id,$body)
    {
        $this->reply_id = $reply_id;
        $this->body=$body;
    }
    public function render()
    {
        return view('livewire.edit-reply');
    }
    public function update()
    {

        $reply = Reply::find($this->reply_id);
        $this->authorize('update', $reply);
        $reply->update(['body' => $this->body]);
        $this->emit('replyEdited');
    }

}
