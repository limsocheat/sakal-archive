<?php

namespace App\Traits;

use App\Models\Media;
use Plank\Mediable\Mediable;

trait HasFeaturedImageTrait
{

    use Mediable;

    public static function bootHasFeaturedImageTrait()
    {
        static::saved(function ($model) {
            if (request('featured_image_id')) :
                $model->syncMedia(request('featured_image_id'), 'featured_image');
            endif;
        });
    }

    /**
     * Get featured_image attribute 
     * 
     * @return Media|null
     */
    public function getFeaturedImageAttribute()
    {
        return $this->firstMedia('featured_image');
    }

    /** 
     * Get featured_image_id attribute
     * 
     * @return int|null
     */
    public function getFeaturedImageIdAttribute()
    {
        return $this->featured_image ? $this->featured_image->id : null;
    }

    /**
     * Get featured_image_url attribute.
     * 
     * @return String|null
     */
    public function getFeaturedImageUrlAttribute()
    {
        return $this->featured_image ? $this->featured_image->findVariant(Media::VARIANT_NAME_MEDIUM)->getUrl() : null;
    }

    /**
     * Sync featured_image by id.
     * 
     * @param int $featuredImageId
     * @return void
     */
    public function syncFeaturedImageById($featuredImageId)
    {
        $this->syncMedia($featuredImageId, 'featured_image');
    }
}
