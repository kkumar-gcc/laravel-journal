<?php

namespace App\Http\Livewire;

use App\Models\Reply as ModelsReply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Reply extends Component
{
    use AuthorizesRequests;
    public $comment_id;
    public $canReply;
    public $description;
    protected $listeners = ['replyEdited'];

    public function replyEdited()
    {
        $this->render();
    }
    public function mount($comment_id,$canReply)
    {
        $this->comment_id = $comment_id;
        $this->canReply=$canReply;
    }
    public function render()
    {
        return view('livewire.reply',[
            "replies" => ModelsReply::where('comment_id','=',$this->comment_id)->latest()->cursorPaginate()
        ]);
    }
    public function delete($reply_id)
    {
        $reply = ModelsReply::find($reply_id);
        $this->authorize('delete', $reply);
        $reply->delete();
    }
    public function reply()
    {
        ModelsReply::create([
            'description' =>  $this->description,
            'comment_id' => $this->comment_id,
            'user_id' => auth()->id()
        ]);
        $this->reset('description');
    }

}
