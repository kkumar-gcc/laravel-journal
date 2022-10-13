<?php

namespace App\Http\Livewire\Admin\Permission;

use Livewire\Component;
use Spatie\Permission\Models\Permission;

class Index extends Component
{
    public $permissions;
    public $name;
    public $permission_id;
    
    public function render()
    {
        $this->permissions=Permission::orderBy('name', 'ASC')->get();
        return view('livewire.admin.permission.index');
    }

    protected $rules = [
        'name' => ['required','min:3'],
    ];
    public function edit(Permission $permission){
        if(!auth()->user()->can('edit permissions')) {
            return abort(403);
        }
        $this->name = $permission->name;
        $this->permission_id = $permission->id;
        $this->emit('editPermission');
    }

    public function deleteConfirm(Permission $permission){
        if(!auth()->user()->can('delete permissions')) {
            return abort(403);
        }
        $this->name = $permission->name;
        $this->permission_id = $permission->id;
        $this->emit('deletePermission');
    }
    public function update(Permission $permission)
    {
        if(!auth()->user()->can('edit permissions')) {
            return abort(403);
        }
        $this->validate();
        $permission->update(["name" => $this->name]);
        $this->reset(['name','permission_id']);
        $this->emit('closeModal');
    }
    public function delete(Permission $permission)
    {
        if(!auth()->user()->can('delete permissions')) {
            return abort(403);
        }
        $permission->delete();
        $this->reset(['name','permission_id']);
        $this->emit('closeModal');
    }
    public function store()
    {
        if(!auth()->user()->can('create permissions')) {
            return abort(403);
        }
        $this->validate();
        Permission::create(["name" => $this->name]);
        $this->emit('closeModal');
    }
}
