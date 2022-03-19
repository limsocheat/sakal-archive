<?php

namespace Modules\Academic\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Academic\Models\AcademicCard;
use Modules\Academic\Transformers\Api\V1\AcademicCardResource;

class AcademicCardController extends Controller
{
    /**
     * Academic Card
     * 
     * Show student academic card (eCard) filtered by current loggedin student.
     * 
     * @param  \Illuminate\Http\Request  $request
     * 
     * @group Academic Module
     * @queryParam string filter[academic_year] optional filter by academic_year uuid. Example: d8f1b8f8-b8a3-11e9-b23e-0242ac130003
     * @apiResource Modules\Academic\Transformers\Api\V1\AcademicCardResource
     * @apiResourceModel Modules\Academic\Models\AcademicCard
     * @authenticated
     */
    public function index(Request $request)
    {
        try {
            $academicCard           = AcademicCard::where('student_id', $request->user()->id)->first();
            if ($academicCard) :
                $academicCard       = new AcademicCardResource($academicCard);
            endif;

            DB::commit();
            return $this->responseSuccess($academicCard);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }
}
