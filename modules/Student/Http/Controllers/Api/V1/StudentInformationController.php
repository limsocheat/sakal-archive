<?php

namespace Modules\Student\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Student\Models\Student;
use Modules\Student\Transformers\V1\StudentInformationResource;

class StudentInformationController extends Controller
{

    /**
     * Student Information 
     * 
     * Display student information
     * 
     * @group Student Module
     * @authenticated
     * 
     * @apiResource \Modules\Student\Transformers\V1\StudentInformationResource
     * @apiResourceModel \Modules\Student\Models\Student
     * 
     */
    public function index()
    {
        DB::beginTransaction();

        try {

            $student        = auth()->user();
            $student        = Student::findByUuidOrFail($student->uuid);
            $student        = new StudentInformationResource($student);

            DB::commit();
            return $this->responseSuccess($student);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }
}
