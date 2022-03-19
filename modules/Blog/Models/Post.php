<?php

namespace Modules\Blog\Models;

use App\Traits\HasFeaturedImageTrait;
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

class Post extends Model implements Sortable
{
    use HasFactory;
    use BindsOnUuid;
    use GeneratesUuid;
    use HasSlug;
    use HasTranslations;
    use HasFeaturedImageTrait;
    use SoftDeletes;
    use SortableTrait;

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
        return \Modules\Blog\Database\Factories\PostFactory::new();
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

    /**
     * getStatuses 
     * 
     * @return Array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_PUBLISHED  => __('blog::post.status.published'),
            self::STATUS_DRAFT      => __('blog::post.status.draft'),
        ];
    }

    /**
     * Get category_ids attribute.
     * 
     * @return Array
     */
    public function getCategoryIdsAttribute()
    {
        return $this->categories->pluck('id')->toArray();
    }

    /**
     * Get tags_ids attribute.
     * 
     * @return Array
     */
    public function getTagIdsAttribute()
    {
        return $this->tags->pluck('id')->toArray();
    }

    /**
     * categories relationship
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    /**
     * tags relationship
     * 
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function tags()
    {
        return $this->belongsToMany(Tag::class, 'tag_post');
    }

    /**
     * Get formatted_published_at attribute.
     * 
     * @return String
     */
    public function getFormattedPublishedAtAttribute()
    {
        return optional($this->published_at)->format('d/m/Y');
    }

    /**
     * Scope a query by categories.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  String                                $categories
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByCategories($query, $categories)
    {
        return $query->whereHas('categories', function ($query) use ($categories) {
            $categories     = explode(',', $categories);
            $query->whereIn('title->en', $categories);
        });
    }

    /**
     * Scope a query by tags.
     * 
     * @param  \Illuminate\Database\Eloquent\Builder $query
     * @param  String                                $tags
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeByTags($query, $tags)
    {
        return $query->whereHas('tags', function ($query) use ($tags) {
            $tags     = explode(',', $tags);
            $query->whereIn('title->en', $tags);
        });
    }
}
