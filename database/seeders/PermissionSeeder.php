<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'super-admin',
            'admin',
            'writer',
            'user'
        ];
        $permissions = [
            'dashboard' => ['super-admin','admin', 'writer', 'user'],
            'file-manager' => ['super-admin','admin'],
            'langfile-manager' => ['super-admin','admin'],
            'backup-manager' => ['super-admin','admin'],
            'log-manager' => ['super-admin','admin'],
            'settings' => ['super-admin','admin'],
            'page-manager' => ['super-admin','admin'],
            'permission-manager' => ['super-admin','admin'],
            'menu-crud' => ['super-admin','admin'],
            'news-crud ' => ['super-admin','admin'],
        ];
        //create roles
        foreach ($roles as $role) {
            $rolesArray[$role] = Role::create(['name' => $role]);
        }
        //create permissions
        foreach ($permissions as $permission => $authorized_roles) {
            //create permission
            Permission::create(['name' => $permission]);
            //authorize roles to those permissions
            foreach ($authorized_roles as $role) {
                $rolesArray[$role]->givePermissionTo($permission);
            }
        }
    }
}
