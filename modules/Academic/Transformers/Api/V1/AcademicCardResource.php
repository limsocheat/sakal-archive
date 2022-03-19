<?php

namespace Modules\Academic\Transformers\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class AcademicCardResource extends JsonResource
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
            'uuid'                      => $this->uuid,
            'code'                      => $this->code,
            'student_profile_photo_url' => optional($this->student)->profile_photo_url,
            'student_first_name'        => optional($this->student)->first_name,
            'student_last_name'         => optional($this->student)->last_name,
            'student_date_of_birth'     => optional($this->student)->date_of_birth,
            'faculty_name'              => optional($this->faculty)->name,
            'major_name'                => optional($this->major)->name,
            'academic_year_name'        => optional($this->academicYear)->name,
            'academic_generation_name'  => optional($this->academicGeneration)->name,
            'expired_at'                => optional($this->expired_at)->format('Y-m-d H:i:s'),
        ];
    }
}
