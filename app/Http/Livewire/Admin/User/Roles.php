<?php

namespace App\Http\Livewire\Admin\User;

use App\Models\User;
use Livewire\Component;
use Spatie\Permission\Models\Role;

class Roles extends Component
{
    public $user;
    public $roles;
    public $user_id;
    public $assignRole=false;
    public function mount($user_id)
    {
        $this->user_id = $user_id;
        $this->assignRole=false;
    }
    public function showModal(){
       $this->assignRole=!$this->assignRole;
    }
    protected $rules = [
        'name' => ['required', 'min:3'],
    ];
    public function render()
    {
        $this->user=User::find($this->user_id);
        $this->roles=Role::all();
        return view('livewire.admin.user.roles');
    }
    public function assignRole(Role $role,User $user)
    {
        if(!auth()->user()->can('assign roles')) {
            return abort(403);
        }
        $user->assignRole($role);
    }
    public function removeRole(Role $role, User $user)
    {
        if(!auth()->user()->can('assign roles')) {
            return abort(403);
        }
        $user->removeRole($role);
        // $this->reset(['role']);
    }
}
