<?php

namespace Modules\Product\Models;

use Glorand\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class ProductAttribute extends Model implements Sortable
{

    use HasFactory;
    use BindsOnUuid;
    use GeneratesUuid;
    use HasSettingsField;
    use HasTranslations;
    use HasSlug;
    use SortableTrait;
    use SoftDeletes;

    public const TYPE_SELECT = 'select';
    public const TYPE_RADIO = 'radio';
    public const TYPE_COMBO = 'combo';
    public const TYPE_CHECKBOX = 'checkbox';
    public const TYPE_COLOR = 'color';
    public const TYPE_IMAGE = 'image';

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'description',
        'type',
    ];

    /**
     * The attributes that should be translable.
     * 
     * @var array
     */
    public $translatable =
    [
        'name', 'description'
    ];

    /**
     * The attributes that should be cast to native types.
     * 
     * @var array
     */
    protected $casts = [
        'active' => 'boolean',

    ];

    /**
     * Get factory for the model.
     * 
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    protected static function newFactory()
    {
        return \Modules\Product\Database\Factories\ProductAttributeFactory::new();
    }

    /**
     * Get the options for generating the slug.
     * 
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

    /**
     * getProductAttributeType
     * 
     */
    public static function getProductAttributeTypes()
    {
        return [
            self::TYPE_SELECT,
            self::TYPE_RADIO,
            self::TYPE_COMBO,
            self::TYPE_CHECKBOX,
            self::TYPE_COLOR,
            self::TYPE_IMAGE,
        ];
    }

    /**
     * values relationship
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function values()
    {
        return $this->hasMany(ProductAttributeValue::class);
    }
}
