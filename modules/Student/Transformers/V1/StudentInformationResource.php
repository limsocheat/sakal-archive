<?php

namespace Modules\Student\Transformers\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class StudentInformationResource extends JsonResource
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
            'full_name'     => $this->full_name,
            'first_name'    => $this->first_name,
            'last_name'     => $this->last_name,
            'email'         => $this->email,
            'phone'         => $this->phone,
            'address'       => $this->address,
            'date_of_birth' => $this->date_of_birth,
        ];
    }
}
