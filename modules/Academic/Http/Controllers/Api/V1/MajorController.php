<?php

namespace Modules\Academic\Http\Controllers\Api\V1;

use Algolia\AlgoliaSearch\Http\Psr7\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Academic\Models\Major;
use Modules\Academic\Transformers\Api\V1\MajorResource;

class MajorController extends Controller
{

    /**
     * Major list
     * 
     * The endpoint to response list of majors
     * 
     * @group Academic Module
     * @queryParam string filter['name'] optional filter by name
     * 
     * @apiResourceCollection Modules\Academic\Transformers\Api\V1\MajorResource
     * @apiResourceModel Modules\Academic\Models\Major
     * 
     */

    public function index()
    {
        DB::beginTransaction();
        try {
            $majors     = Major::get();

            $majors     =  MajorResource::collection($majors);
            DB::commit();
            return $this->responseSuccess($majors);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * Show Major
     * 
     * The endpoint to response single major by uuid
     * 
     * @group Academic Module
     * 
     * @param Request $request
     * 
     * @urlParam major string required The uuid of the major. Example: d8f1b8f8-b8a3-11e9-b23e-0242ac130003
     * @apiResource Modules\Academic\Transformers\Api\V1\MajorResource
     * @apiResourceModel Modules\Academic\Models\Major
     */
    public function show(Request $request, Major $major)
    {
        DB::beginTransaction();
        try {

            $major  =  new MajorResource($major);
            DB::commit();
            return $this->responseSuccess($major);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }
}
