<?php

namespace Modules\Product\Models;

use App\Traits\HasFeaturedImageTrait;
use BinaryCats\Sku\Concerns\SkuOptions;
use BinaryCats\Sku\HasSku;
use Glorand\Model\Settings\Traits\HasSettingsField;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Laravel\Scout\Searchable;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\HasTranslatableSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Product extends Model implements Sortable
{
    use HasFactory;
    use HasTranslations;
    use HasSlug;
    use BindsOnUuid;
    use GeneratesUuid;
    use HasSettingsField;
    use HasSku;
    use HasFeaturedImageTrait;
    use SoftDeletes;
    use SortableTrait;
    use Searchable;

    public const TYPE_SIMPLE = 'simple';
    public const TYPE_VARIABLE = 'variable';

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'name',
        'price',
        'description',
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
        return \Modules\Product\Database\Factories\ProductFactory::new();
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
     * Get the options for generating the Sku.
     *
     * @return BinaryCats\Sku\SkuOptions
     */
    public function skuOptions(): SkuOptions
    {
        return SkuOptions::make()
            ->from(['name'])
            ->target('sku')
            ->using('_')
            ->forceUnique(false)
            ->generateOnCreate(true)
            ->refreshOnUpdate(false);
    }

    /**
     * Get product types
     * 
     * @return Array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_SIMPLE => __('Simple'),
            self::TYPE_VARIABLE => __('Variable'),
        ];
    }


    /**
     * variations relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function variations()
    {
        return $this->hasMany(ProductVariation::class);
    }

    /**
     * attribute_value_items relation
     * 
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function attribute_value_items()
    {
        return $this->hasMany(ProductAttributeValueItem::class);
    }


    /**
     * Get active_status attribute
     * 
     * @return string
     */
    public function getActiveStatusAttribute()
    {
        return $this->active ? __('Active') : __('Inactive');
    }

    /**
     * Get product_attribute_group_count attribute
     * 
     * @return int
     */
    public function getProductAttributeGroupCountAttribute()
    {
        return $this->attribute_value_items()->groupBy('product_attribute_id')->count();
    }
}
