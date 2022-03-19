<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Services\ModuleService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Nwidart\Modules\Facades\Module;

class ModuleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        $modules    = Module::all();

        $data       = [
            'modules' => $modules,
        ];

        return view('dashboard.modules.index', $data);
    }

    /**
     * Enable a module.
     *
     * @param  string  $module
     * @return \Illuminate\Http\Response
     */
    public function enable($module)
    {
        DB::beginTransaction();
        try {

            ModuleService::enable($module);
            DB::commit();
            flash()->success(__('Module enabled successfully.'));
            return redirect()->route('dashboard.modules.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Disable a module.
     *
     * @param  string  $module
     * @return \Illuminate\Http\Response
     */
    public function disable($module)
    {
        Module::disable($module);

        return redirect()->route('dashboard.modules.index');
    }
}
