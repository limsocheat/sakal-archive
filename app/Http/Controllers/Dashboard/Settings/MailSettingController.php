<?php

namespace App\Http\Controllers\Dashboard\Settings;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MailSettingController extends Controller
{
    /**
     * Display mail settings form 
     * 
     * @return \Illuminate\Contracts\View\View
     */
    public function index()
    {

        $settings       =  setting()->get('mail');

        return view('dashboard.settings.mail', compact('settings'));
    }

    /**
     * Store settings
     * 
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $settings       = $request->except('_token');

            setting()->set('mail', $settings);
            setting()->save();
            DB::commit();
            flash()->success(__('Settings saved successfully'));
            return redirect()->back();
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
