<?php

namespace Modules\Academic\Models;

use App\Traits\HasUuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class Faculty extends Model
{
    use HasFactory;
    use HasTranslations;
    use HasUuidTrait;
    use SoftDeletes;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'active',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'active'      => 'boolean',
    ];

    /**
     * The attributes that are translatable.
     * 
     * @var array
     */
    protected $translatable = [
        'name',
        'description',
    ];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Academic\Database\Factories\FacultyFactory::new();
    }
}
