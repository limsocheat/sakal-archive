<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $arrayOfPermissionNames = [
            Permission::ALL_USERS, Permission::VIEW_USERS, Permission::CREATE_USERS, Permission::EDIT_USERS, Permission::DELETE_USERS, Permission::RESTORE_USERS, Permission::FORCE_DELETE_USERS,
            Permission::ALL_ROLES, Permission::VIEW_ROLES, Permission::CREATE_ROLES, Permission::EDIT_ROLES, Permission::DELETE_ROLES, Permission::RESTORE_ROLES, Permission::FORCE_DELETE_ROLES,
            Permission::ALL_MODULES, Permission::VIEW_MODULES, Permission::CREATE_MODULES, Permission::EDIT_MODULES, Permission::DELETE_MODULES, Permission::RESTORE_MODULES, Permission::FORCE_DELETE_MODULES,
            Permission::ALL_MEDIA, Permission::VIEW_MEDIA, Permission::CREATE_MEDIA, Permission::EDIT_MEDIA, Permission::DELETE_MEDIA, Permission::RESTORE_MEDIA, Permission::FORCE_DELETE_MEDIA,
        ];
        $permissions = collect($arrayOfPermissionNames)->map(function ($permission) {
            return ['name' => $permission, 'guard_name' => 'web'];
        });

        foreach ($permissions as $permission) :
            Permission::updateOrCreate(['name' => $permission['name'], 'guard_name' => $permission['guard_name']], array_merge($permission, ['module' => 'core']));
        endforeach;

        $arrayOfRoleNames = [
            Role::ADMINISTRATOR,
            Role::MANAGER,
            Role::USER,
        ];

        $roles = collect($arrayOfRoleNames)->map(function ($role) {
            return ['name' => $role];
        });

        foreach ($roles as $role) :
            Role::updateOrCreate(['name' => $role['name']], $role);
        endforeach;
    }
}
