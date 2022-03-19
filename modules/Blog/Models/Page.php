<?php

namespace Modules\Blog\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Dyrynda\Database\Support\BindsOnUuid;
use Dyrynda\Database\Support\GeneratesUuid;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Spatie\Translatable\HasTranslations;

class Page extends Model implements Sortable
{
    use HasFactory;
    use BindsOnUuid;
    use GeneratesUuid;
    use HasTranslations;
    use HasSlug;
    use SortableTrait;
    use SoftDeletes;

    public const STATUS_DRAFT = 'draft';
    public const STATUS_PUBLISHED = 'published';

    public const FORMAT_STANDARD = 'standard';
    public const FORMAT_VIDEO = 'video';
    public const FORMAT_AUDIO = 'audio';

    /**
     * The attributes that should be fillable
     * 
     * @var array
     */
    protected $fillable = [
        'title',
        'content',
        'status',
        'format',
        'published_at',
    ];

    /**
     * The attributes that should be translable.
     * 
     * @var array
     */
    public $translatable = [
        'title',
        'content'
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
        return \Modules\Blog\Database\Factories\PageFactory::new();
    }

    /**
     * Get the options for generating the slug.
     * 
     * @return \Spatie\Sluggable\SlugOptions
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('title')
            ->saveSlugsTo('slug');
    }
}
