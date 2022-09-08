<?php

namespace App\Http\Livewire;

use App\Models\User;
use Livewire\Component;

class TopUsers extends Component
{
    public $users;
    public function mount()
    {
        $this->users = User::select(['id','username','profile_image'])->limit(5)->get();
    }
    public function render()
    {
        return view('livewire.top-users',["topUsers"=>$this->users]);
    }
}
