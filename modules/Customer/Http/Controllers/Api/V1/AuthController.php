<?php

namespace Modules\Customer\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Customer\Http\Requests\CustomerFirebaseAuth;
use Modules\Customer\Transformers\Api\V1\CustomerResource;

class AuthController extends Controller
{
    public function user(Request $request)
    {
        DB::beginTransaction();

        try {
            $user           = $request->user();
            $user           = new CustomerResource($user);

            DB::commit();
            return $this->responseSuccess($user);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }

    public function firebase(CustomerFirebaseAuth $request)
    {
        DB::beginTransaction();

        try {

            $data      = $request->authenticate(
                $request->input('firebase_uid'),
                $request->input('device_name'),
                $request->only([
                    'first_name',
                    'last_name',
                    'phone',
                    'email',
                    'title',
                    'profile_url',
                ])
            );

            DB::commit();
            return $this->responseSuccess($data);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }
}
