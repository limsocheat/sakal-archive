<?php

namespace Modules\Student\Models;

use App\Traits\HasUuidTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Translatable\HasTranslations;

class Student extends Authenticatable
{
    use HasFactory;
    use HasTranslations;
    use HasApiTokens;
    use HasUuidTrait;
    use HasProfilePhoto;
    use SoftDeletes;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'first_name',
        'last_name',
        'date_of_birth',
        'place_of_birth',
        'gender',
        'nationality',
        'address',
        'phone',
        'email',
        'password',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [];

    /**
     * The attributes that should be translable.
     * 
     * @var array
     */
    public $translatable = [
        'first_name',
        'last_name'
    ];

    /**
     * The attributes that should be hidden for arrays.
     * 
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Student\Database\Factories\StudentFactory::new();
    }

    /**
     * Get full_name attribute.
     * 
     * @return string
     */
    public function getFullNameAttribute()
    {
        return trim("{$this->first_name} {$this->last_name}");
    }
}
