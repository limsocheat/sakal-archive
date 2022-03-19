<?php

namespace Modules\Student\Transformers\V1\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentResource extends JsonResource
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
            'uuid'          => $this->uuid,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'gender'        => $this->gender,
            'nationality'   => $this->nationality,
        ];
    }
}
