<?php

namespace App\View\Components;

use App\Contracts\Constants\MenuConstant;
use Illuminate\View\Component;

class SettingLayout extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {

        $menu       = MenuConstant::NAME_DASHBOARD_SETTING;

        return view('layouts.setting', compact('menu'));
    }
}
