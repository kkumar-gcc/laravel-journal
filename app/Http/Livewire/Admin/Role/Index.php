<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Index extends Component
{
    public $roles;
    public $name;

    public $role_id;
    public $permissions = [];
    public $role_permissions=[];
    protected $listeners = ['roleUpdated' => '$refresh'];
    public function render()
    {
        $this->roles = Role::whereNotIn('name', ['super-admin'])->get();
        return view('livewire.admin.role.index');
    }
    protected $rules = [
        'name' => ['required', 'min:3'],
    ];
    public function editPermission(Role $role)
    {
        $this->role_id = $role->id;
        $this->role_permissions=$role->permissions;
        $this->permissions = Permission::all();
        $this->emit('assignPermission');
    }

    public function deleteConfirm(Role $role)
    {
        if(!auth()->user()->can('delete roles')) {
            return abort(403);
        }
        $this->name = $role->name;
        $this->role_id = $role->id;
        $this->emit('deleteRole');
    }
    public function delete(Role $role)
    {
        if(!auth()->user()->can('delete roles')) {
            return abort(403);
        }
        $role->delete();
        $this->reset(['name', 'role_id']);
        $this->emit('closeModal');
    }
    public function store()
    {
        if(!auth()->user()->can('create roles')) {
            return abort(403);
        }
        $this->validate();
        Role::create(["name" => $this->name]);
        $this->emit('closeModal');
    }
}
