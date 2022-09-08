<?php

namespace App\Http\Livewire;

use App\Models\Reply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class EditReply extends Component
{
    use AuthorizesRequests;
    public $reply_id;
    public $description;
    public function mount($reply_id,$description)
    {
        $this->reply_id = $reply_id;
        $this->description=$description;
    }
    public function render()
    {
        return view('livewire.edit-reply');
    }
    public function update()
    {

        $reply = Reply::find($this->reply_id);
        $this->authorize('update', $reply);
        $reply->update(['description' => $this->description]);
        $this->emit('replyEdited');
    }

}
