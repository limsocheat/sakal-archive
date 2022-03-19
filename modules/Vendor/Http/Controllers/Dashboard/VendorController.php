<?php

namespace Modules\Vendor\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Vendor\Models\Vendor;

class VendorController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $data       = [
            'items'     => Vendor::get(),
        ];

        return view('vendor::dashboard.vendors.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('vendor::dashboard.vendors.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'first_name'        => ['required'],
            'last_name'         => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $data               = $request->all();
            $vendor             = Vendor::create($data);

            if ($vendor) :
                DB::commit();
                flash()->success(__('vendor created successfully'));
                return redirect()->route('dashboard.vendors.index');
            else :
                DB::rollBack();
                flash()->warning(__('vendor not created'));
                return redirect()->back();
            endif;
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('vendor::dashboard.vendors.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Vendor $vendor)
    {
        return view('vendor::dashboard.vendors.edit', compact('vendor'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Vendor $vendor)
    {
        $request->validate([
            'first_name'        => ['required'],
            'last_name'         => ['required'],
        ]);

        DB::beginTransaction();
        try {
            $data               = $request->all();
            $vendor->update($data);

            if ($vendor) :
                DB::commit();
                flash()->success(__('vendor updated successfully'));
                return redirect()->route('dashboard.vendors.index');
            else :
                DB::rollBack();
                flash()->warning(__('vendor not updated'));
                return redirect()->back();
            endif;
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
