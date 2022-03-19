<?php

namespace Modules\Student\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Modules\Student\Models\Student;
use Modules\Student\Transformers\V1\Auth\StudentResource;

class AuthController extends Controller
{
    /**
     * 
     * Show the logged-in student profile.
     * 
     * @group Student Module
     * @authenticated
     * 
     * @apiResource \Modules\Student\Transformers\V1\Auth\StudentResource
     * @apiResourceModel \Modules\Student\Models\Student
     * 
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Auth\Access\AuthorizationException
     * @throws \Illuminate\Auth\AuthenticationException
     * 
     */
    public function index()
    {
        DB::beginTransaction();

        try {
            $student        = new StudentResource(auth()->user());
            DB::commit();
            return $this->responseSuccess($student);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * 
     * Register a new student.
     * 
     * Allow student to register with email and password
     * and upload verified document.
     * 
     * @group Student Module
     * 
     * @bodyParam first_name string required The first name of the student.
     * @bodyParam last_name string required The last name of the student.
     * @bodyParam email string required The email of the student.
     * @bodyParam password string required The password of the student.
     * @bodyParam password_confirmation string required The password confirmation of the student.
     * @bodyParam device_name string required The device name.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {

        $request->validate([
            'first_name'    => ['required', 'string', 'max:255'],
            'last_name'     => ['required', 'string', 'max:255'],
            'email'         => ['required', 'string', 'email', 'max:255', 'unique:students'],
            'password'      => ['required', 'string', 'min:6', 'confirmed'],
            'device_name'   => ['required'],
        ]);

        DB::beginTransaction();

        try {
            $data               = $request->only('first_name', 'last_name', 'email');
            $data['password']   = bcrypt($request->input('password'));
            $customer           = Student::create($data);
            $token              = $customer->createToken($request->input('device_name'))->plainTextToken;

            DB::commit();
            return $this->responseSuccess($token);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * 
     * Login a student.
     * 
     * Login a student with email and password.
     * 
     * @group Student Module
     * 
     * @bodyParam email string required The email of the student.
     * @bodyParam password string required The password of the student.
     * @bodyParam device_name string required The device name.
     * 
     */
    public function login(Request $request)
    {
        $request->validate([
            'email'         => ['required', 'string', 'email', 'max:255'],
            'password'      => ['required', 'string', 'min:6'],
            'device_name'   => ['required'],
        ]);

        DB::beginTransaction();

        try {
            $student = Student::where('email', $request->input('email'))->first();

            if (!$student) {
                return $this->responseError('Email address not found.');
            }

            $credentials = $request->validate([
                'email' => ['required', 'email'],
                'password' => ['required'],
            ]);

            if (!Auth::guard('student')->attempt($credentials)) {
                DB::rollBack();
                return $this->responseError(__('auth.failed'));
            }

            DB::commit();
            return $this->responseSuccess($student->createToken($request->input('device_name'))->plainTextToken);
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * 
     * Logout a student.
     * 
     * Logout a student with token.
     * 
     * @group Student Module
     * @authenticated
     * 
     * @bodyParam device_name string required The device name.
     * 
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        $request->validate([
            'device_name'   => ['required'],
        ]);

        DB::beginTransaction();

        try {
            auth()->user()->tokens()->where('name', $request->input('device_name'))->delete();
            DB::commit();
            return $this->responseSuccess(__('Logout successfully'));
        } catch (\Exception $e) {
            DB::rollBack();
            return $this->responseError($e->getMessage());
        }
    }
}
