<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Permission as ModelsPermission;

class Permission extends ModelsPermission
{
    use HasFactory;

    public const ALL_USERS = 'all users';
    public const VIEW_USERS = 'view users';
    public const CREATE_USERS = 'create users';
    public const EDIT_USERS = 'edit users';
    public const DELETE_USERS = 'delete users';
    public const RESTORE_USERS = 'restore users';
    public const FORCE_DELETE_USERS = 'force delete users';

    public const ALL_ROLES = 'all roles';
    public const VIEW_ROLES = 'view roles';
    public const CREATE_ROLES = 'create roles';
    public const EDIT_ROLES = 'edit roles';
    public const DELETE_ROLES = 'delete roles';
    public const RESTORE_ROLES = 'restore roles';
    public const FORCE_DELETE_ROLES = 'force delete roles';

    public const ALL_MODULES = 'all modules';
    public const VIEW_MODULES = 'view modules';
    public const CREATE_MODULES = 'create modules';
    public const EDIT_MODULES = 'edit modules';
    public const DELETE_MODULES = 'delete modules';
    public const RESTORE_MODULES = 'restore modules';
    public const FORCE_DELETE_MODULES = 'force delete modules';

    public const ALL_MEDIA = 'all media';
    public const VIEW_MEDIA = 'view media';
    public const CREATE_MEDIA = 'create media';
    public const EDIT_MEDIA = 'edit media';
    public const DELETE_MEDIA = 'delete media';
    public const RESTORE_MEDIA = 'restore media';
    public const FORCE_DELETE_MEDIA = 'force delete media';

    protected $fillable = [
        'name',
        'guard_name',
        'module',
    ];
}
