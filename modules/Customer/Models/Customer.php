<?php

namespace Modules\Customer\Models;

use Glorand\Model\Settings\Traits\HasSettingsField;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Laravel\Sanctum\HasApiTokens;

class Customer extends Authenticatable
{
    use HasFactory;
    use BindsOnUuid;
    use GeneratesUuid;
    use SoftDeletes;
    use HasApiTokens;
    use Notifiable;
    use HasSettingsField;

    protected $fillable = [
        'code',
        'firebase_uid',
        'phone',
        'email',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'gender',
        'is_new_user',
        'phone_verified_at',
        'email_verified_at',
        'password',
        'data',
        'active',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'is_new_user'   => 'boolean',
        'data'          => 'json',
        'active'        => 'boolean',
    ];

    protected static function newFactory()
    {
        return \Modules\Customer\Database\Factories\CustomerFactory::new();
    }

    /**
     * Get customer's name from title, first name, middle name and last name.
     * 
     * @return string
     */
    public function getNameAttribute()
    {
        return trim($this->title . ' ' . $this->first_name . ' ' . $this->middle_name . ' ' . $this->last_name);
    }
}
