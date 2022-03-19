<?php

namespace Modules\Vendor\Models;

use Glorand\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;

class Vendor extends Model
{
    use HasFactory;
    use BindsOnUuid;
    use GeneratesUuid;
    use HasSettingsField;

    public const TYPE_COMPANY = 'company';
    public const TYPE_PERSON = 'person';

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'legal_name',
        'company_name',
        'title',
        'first_name',
        'middle_name',
        'last_name',
        'display_name',
        'email',
        'phone',
        'address',
        'province',
        'country',
        'description',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Vendor\Database\Factories\VendorFactory::new();
    }
}
