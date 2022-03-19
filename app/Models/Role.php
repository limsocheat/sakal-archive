<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Spatie\Permission\Models\Role as ModelsRole;

class Role extends ModelsRole
{
    use HasFactory;

    public const ADMINISTRATOR = 'administrator';
    public const MANAGER = 'manager';
    public const USER = 'user';

    public const GUARD_WEB = 'web';
    public const GUARD_API = 'api';

    protected $fillable = [
        'name',
        'guard_name',
    ];

    /**
     * Get is_super_admin attribute.
     * 
     * @return bool
     */
    public function getIsSuperAdminAttribute()
    {
        return $this->name === self::ADMINISTRATOR;
    }

    /**
     * Get guards properties 
     * 
     * @return array
     */
    public static function guards()
    {
        return [
            self::GUARD_WEB => self::GUARD_WEB,
            self::GUARD_API => self::GUARD_API,
        ];
    }

    /**
     * Get permission_names attribute.
     * 
     * @return array
     */
    public function getPermissionNamesAttribute()
    {
        return $this->permissions->pluck('name')->toArray();
    }
}
