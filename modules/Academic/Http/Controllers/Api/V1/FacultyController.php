<?php

namespace Modules\Academic\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Academic\Models\Faculty;
use Modules\Academic\Transformers\Api\V1\FacultyResource;
use Spatie\QueryBuilder\QueryBuilder;

class FacultyController extends Controller
{
    /**
     * Faculty List
     * 
     * The endpoint to response list of faculties
     * 
     * @queryParam string filter[name] optional filter by name.
     * @group Academic Module
     * @apiResourceCollection Modules\Academic\Transformers\Api\V1\FacultyResource
     * @apiResourceModel Modules\Academic\Models\Faculty
     * 
     */
    public function index()
    {

        DB::beginTransaction();
        try {
            $faculties      = QueryBuilder::for(Faculty::class)
                ->allowedFilters(['name'])
                ->get();
            $faculties      = FacultyResource::collection($faculties);
            DB::commit();
            return $this->responseSuccess($faculties);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * Show Faculty
     * 
     * The endpoint to response single faculty by uuid
     * @group Academic Module
     * 
     * @param Request $request
     * 
     * @urlParam faculty string required The uuid of the faculty. Example: d8f1b8f8-b8a3-11e9-b23e-0242ac130003
     * @apiResource Modules\Academic\Transformers\Api\V1\FacultyResource
     * @apiResourceModel Modules\Academic\Models\Faculty
     */
    public function show(Request $request, Faculty $faculty)
    {
        DB::beginTransaction();
        try {
            $faculty        = new FacultyResource($faculty);
            DB::commit();
            return $this->responseSuccess($faculty);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }
}
