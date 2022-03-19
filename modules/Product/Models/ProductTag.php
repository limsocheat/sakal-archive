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

class ProductTag extends Model implements Sortable
{
    use HasFactory;
    use HasTranslatableSlug;
    use HasSlug;
    use BindsOnUuid;
    use GeneratesUuid;
    use HasSettingsField;
    use SoftDeletes;
    use SortableTrait;

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
        return \Modules\Product\Database\Factories\ProductTagFactory::new();
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
}
