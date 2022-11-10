<?php

namespace App\Http\Livewire;

use App\Gamify\Points\ReplyCreated;
use App\Models\Reply as ModelsReply;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class Reply extends Component
{
    use AuthorizesRequests;
    public $comment_id;
    public $canReply;
    public $body;
    // protected $listeners = ['replyEdited'];

    // public function replyEdited()
    // {
    //     $this->render();
    // }
    public function mount($comment_id,$canReply)
    {
        $this->comment_id = $comment_id;
        $this->canReply=$canReply;
    }
    public function render()
    {
        return view('livewire.reply',[
            "replies" => ModelsReply::where('comment_id','=',$this->comment_id)->orderBy('created_at','DESC')->cursorPaginate()
        ]);
    }
    public function replyIndex($comment_id){
        $this->reset('body');
        // dd($this->body,$comment_id);
        $this->comment_id = $comment_id;
        // $this->emit('reply',);
        $this->emit('replyreply',$this->body,$this->comment_id);
    }
    public function delete($reply_id)
    {

        $reply = ModelsReply::find($reply_id);
        $this->authorize('delete', $reply);
        undoPoint(new ReplyCreated($reply));
        $reply->delete();
    }
    public function reply()
    {
        $reply=ModelsReply::create([
            'body' =>  $this->body,
            'comment_id' => $this->comment_id,
            'user_id' => auth()->id()
        ]);
        givePoint(new ReplyCreated($reply));
        $this->reset('body');
    }

}
