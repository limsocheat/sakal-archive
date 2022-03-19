<?php

namespace Modules\Academic\Models;

use App\Traits\HasUuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Spatie\Translatable\HasTranslations;

class AcademicGeneration extends Model
{
    use HasFactory;
    use HasUuidTrait;
    use HasTranslations;
    use SoftDeletes;

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'major_id',
        'name',
        'description',
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'active'    => 'boolean',
    ];

    /**
     * The attributes that should be translable.
     * 
     * @var array
     */
    public $translatable = [
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
        return \Modules\Academic\Database\Factories\AcademicGenerationFactory::new();
    }
}
