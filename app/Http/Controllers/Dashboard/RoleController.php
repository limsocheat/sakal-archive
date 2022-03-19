<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $roles      = Role::get();

        $data       = [
            'items' => $roles,
        ];

        return view('dashboard.users.roles.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function edit(Role $role)
    {

        $modules         = Permission::get()->groupBy('module');
        $permissions     = [];
        foreach ($modules as $key => $module) :
            $grouped = collect($module)->groupBy(function ($item) {
                return substr(strrchr($item->name, " "), 1);
            });

            $permissions    = array_merge($permissions, [$key => $grouped->toArray()]);
        endforeach;


        $data               = [
            'role'          => $role,
            'guards'        => Role::guards(),
            'modules'       => $permissions,
        ];

        return view('dashboard.users.roles.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name'          => ['required'],
            'guard_name'    => ['required'],
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only([
                'name',
                'guard_name',
            ]);

            $role->update($data);

            if ($role) :

                $role->syncPermissions($request->input('permission_names', []));

                DB::commit();
                flash()->success('Role has been updated successfully.');
                return redirect()->back();
            else :
                DB::rollBack();
                flash()->warning('Role has not been updated successfully.');
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
     *
     * @param  \App\Models\Role  $role
     * @return \Illuminate\Http\Response
     */
    public function destroy(Role $role)
    {
        //
    }
}
