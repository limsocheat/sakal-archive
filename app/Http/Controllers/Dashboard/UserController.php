<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Permission;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Spatie\QueryBuilder\QueryBuilder;

class UserController extends Controller
{

    /**
     * Create the controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->authorizeResource(User::class, 'user');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $items      = QueryBuilder::for(User::class)
            ->allowedFilters(['name', 'email'])
            ->allowedSorts(['name', 'email'])
            ->get();

        $data       = [
            'items'  => $items,
        ];

        return view('dashboard.users.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $roles      = Role::get()->pluck('name', 'id')->toArray();

        $data       = [
            'roles'  => $roles,
        ];

        return view('dashboard.users.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'unique:users,email'],
            'password'  => ['required', 'confirmed'],
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only([
                'name',
                'email',
            ]);
            $data['password']   = bcrypt($request->password);

            $user       = User::create($data);
            if ($user) :
                $user->assignRole($request->input('role_id'));
                DB::commit();
                flash()->success('User has been created successfully.');
                return redirect()->route('dashboard.users.index');
            else :
                DB::rollBack();
                flash()->error('User has not been created successfully.');
                return redirect()->route('dashboard.users.create');
            endif;
        } catch (\Exception $e) {
            DB::rollBack();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        $permissions        = Permission::get();
        $grouped = $permissions->groupBy(function ($item) {
            return substr(strrchr($item->name, " "), 1);
        });
        $permissions          = $grouped->toArray();

        $data       = [
            'roles'         => Role::get()->pluck('name', 'id')->toArray(),
            'user'          => $user,
            'permissions'   => $permissions,
        ];

        return view('dashboard.users.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'      => ['required'],
            'email'     => ['required', 'unique:users,email,' . $user->id],
        ]);

        DB::beginTransaction();

        try {
            $data       = $request->only([
                'name',
                'email',
            ]);

            $user->update($data);
            if ($user) :
                $user->syncRoles($request->input('role_id'));
                DB::commit();
                flash()->success('User has been updated successfully.');
                return redirect()->route('dashboard.users.index');
            else :
                DB::rollBack();
                flash()->warning('User has not been updated successfully.');
                return redirect()->route('dashboard.users.create');
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
