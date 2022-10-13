<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Role;

class Edit extends Component
{
    public $name;
    public $role;
    public $editRole=false;
    public function mount(Role $role)
    {
        $this->role = $role;
        $this->name = $role->name;
        $this->editRole=false;
    }
    public function showModal(){
        if(!auth()->user()->can('edit roles')) {
            return abort(403);
        }
       $this->editRole=!$this->editRole;
    }
    protected $rules = [
        'name' => ['required', 'min:3'],
    ];
    public function render()
    {
        return view('livewire.admin.role.edit');
    }
    public function update(Role $role)
    {
        if(!auth()->user()->can('edit roles')) {
            return abort(403);
        }
        $this->validate();
        $role->update(["name" => $this->name]);
        $this->reset(['name']);
        $this->emit('roleUpdated');
        $this->editRole=false;
    }
}
