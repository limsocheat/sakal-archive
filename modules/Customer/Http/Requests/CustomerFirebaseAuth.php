<?php

namespace Modules\Customer\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Modules\Customer\Models\Customer;
use Modules\Customer\Transformers\Api\V1\CustomerResource;

class CustomerFirebaseAuth extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'firebase_uid'      => ['required'],
            'device_name'       => ['required'],
        ];
    }

    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Authenticate user with Firebase UID
     * 
     * @return array
     */

    public function authenticate($firebase_uid, $device_name, $data)
    {
        $customer           = Customer::firstOrCreate([
            'firebase_uid'  => $firebase_uid,
        ], $data);

        $token              = $customer->createToken($device_name)->plainTextToken;

        $customer->update(['phone_verified_at'  => now()]);
        $customer           = new CustomerResource($customer);

        return [
            'token'         => $token,
            'user'          => $customer,
            'is_new_user'   => $customer->is_new_user,
        ];
    }
}
