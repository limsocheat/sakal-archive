<?php

namespace Modules\Academic\Transformers\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class MajorResource extends JsonResource
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
            'uuid'            => $this->uuid,
            'faculty_name'    => optional($this->faculty)->name,
            'name'            => $this->name,
            'description'     => $this->description,

        ];
    }
}
