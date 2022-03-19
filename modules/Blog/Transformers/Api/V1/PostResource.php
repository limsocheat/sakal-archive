<?php

namespace Modules\Blog\Transformers\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class PostResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'uuid'                  => $this->uuid,
            'title'                 => $this->title,
            'content'               => $this->content,
            'status'                => $this->status,
            'published_at'          => $this->formatted_published_at,
            'categories'            => $this->categories->pluck('title'),
            'tags'                  => $this->tags->pluck('title'),
            'featured_image_url'    => $this->featured_image_url,
        ];
    }
}
