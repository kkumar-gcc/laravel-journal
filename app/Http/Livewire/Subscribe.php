<?php

namespace App\Http\Livewire;

use App\Models\Subscriber;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Subscribe extends Component
{
    public $user_id;
    public $subscribed = false;
    public $message;
    public function mount($user_id)
    {
        $this->user_id = $user_id;
        if (Auth::check()) {
            if (Subscriber::where([
                ["user_id", "=", $this->user_id],
                ["subscriber_id", "=", auth()->id()]
            ])->count() > 0) {
                $this->subscribed = true;
            }
        }
    }
    public function render()
    {
        return view('livewire.subscribe');
    }
    public function subscribe(){
        if ($this->user_id != auth()->id()) {
            $exist= Subscriber::where([
                ["user_id", "=", $this->user_id],
                ["subscriber_id", "=", auth()->id()]
            ]);
            if ($exist->count() < 1) {
                Subscriber::create([
                    "user_id"=>$this->user_id,
                    "subscriber_id"=>auth()->id(),
                    // "status"=>1
                ]);
                $this->message='follower added successfully.';
                $this->subscribed = true;
            } else {
                $deleted = $exist->delete();
                if ($deleted) {
                    $this->message='unfollowed successfully';
                    $this->subscribed = false;
                } else {
                    $this->message='something goes wrong.';
                }
            }
            $this->emit('changed');
        }
    }
}
