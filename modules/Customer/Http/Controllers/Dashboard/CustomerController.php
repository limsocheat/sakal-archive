<?php

namespace Modules\Customer\Http\Controllers\Dashboard;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Customer\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {

        $data       = [
            'items'     => Customer::get(),
        ];

        return view('customer::dashboard.customers.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * 
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('customer::dashboard.customers.create');
    }

    /**
     * Store a newly created resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'        => ['required'],
            'last_name'         => ['required'],
            'password'          => ['required', 'confirmed'],
        ]);

        DB::beginTransaction();
        try {
            $data               = $request->except('password', 'password_confirmation');
            $data['password']   = bcrypt($request->password);
            $customer           = Customer::create($data);

            if ($customer) :
                DB::commit();
                flash()->success(__('Customer created successfully'));
            else :
                DB::rollBack();
                flash()->warning(__('Customer not created'));
            endif;
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
        }

        return redirect()->route('dashboard.customers.index');
    }

    /**
     * Show the form for editing the specified resource.
     * 
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function edit(Customer $customer)
    {

        $data       = [
            'customer'      => $customer,
        ];

        return view('customer::dashboard.customers.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * 
     * @param  \Illuminate\Http\Request  $request
     * @param Customer $customer
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, Customer $customer)
    {
        $request->validate([
            'first_name'        => ['required'],
            'last_name'         => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $data               = $request->except('password', 'password_confirmation');
            if ($request->has('password') && $request->has('password_confirmation')) :
                $data['password']   = bcrypt($request->input('password'));
            endif;
            $customer           = $customer->update($data);

            if ($customer) :
                DB::commit();
                flash()->success(__('Customer updated successfully'));
                return redirect()->back();
            else :
                DB::rollBack();
                flash()->warning(__('Customer not updated'));
                return redirect()->back();
            endif;
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->warning(__('Customer not updated'));
            return redirect()->back();
        }
    }
}
