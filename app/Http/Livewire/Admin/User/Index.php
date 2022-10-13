<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $listeners = ['userUpdated' => '$refresh'];
    public function render()
    {
        $users = User::paginate(20);
        return view('livewire.admin.user.index')->with(["users" => $users]);
    }
}
