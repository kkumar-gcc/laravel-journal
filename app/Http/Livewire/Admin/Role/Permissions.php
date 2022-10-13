<?php

namespace App\Http\Livewire\Admin\Role;

use Livewire\Component;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class Permissions extends Component
{
    public $role;
    public $permissions=[];
    public $assignPermission=false;
    public function mount($role_id)
    {
        $this->role_id = $role_id;
        $this->assignPermission=false;
    }
    public function showModal(){
       $this->assignPermission=!$this->assignPermission;
    }
    public function render()
    {
        $this->role=Role::find($this->role_id);
        $this->permissions = Permission::all();
        return view('livewire.admin.role.permissions');
    }
    public function assignPermission(Permission $permission, Role $role)
    {
        if(!auth()->user()->can('assign permissions')) {
            return abort(403);
        }
        $permission->assignRole($role);
    }
    public function removePermission(Permission $permission, Role $role)
    {
        if(!auth()->user()->can('assign permissions')) {
            return abort(403);
        }
        $role->revokePermissionTo($permission);
        // $this->reset(['role']);
    }
}
