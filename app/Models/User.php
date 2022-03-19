<?php

namespace App\Models;

use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use BindsOnUuid;
    use GeneratesUuid;
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use HasRoles;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    /**
     * Get role_names attribute
     * seperate roles by comma, transform to upper case
     * 
     * @return string
     */
    public function getRoleNamesAttribute()
    {
        $roles      = $this->roles->pluck('name')->toArray();

        return implode(', ', array_map('ucfirst', $roles));
    }

    /**
     * Get role_id attribute
     * 
     * @return int
     */
    public function getRoleIdAttribute()
    {
        return optional($this->roles->first())->id;
    }

    /**
     * Get is_super_admin attribute
     * 
     * @return bool
     */
    public function getIsSuperAdminAttribute()
    {
        return $this->roles->pluck('name')->contains(Role::ADMINISTRATOR);
    }

    /**
     * Get permission_names attribute.
     * 
     * @return array
     */
    public function getPermissionNamesAttribute()
    {
        return $this->getPermissionsViaRoles()->pluck('name')->toArray();
    }
}
