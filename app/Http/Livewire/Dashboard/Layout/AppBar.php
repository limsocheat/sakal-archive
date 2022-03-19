<?php

namespace App\Http\Livewire\Dashboard\Layout;

use App\Contracts\Constants\MenuConstant;
use Livewire\Component;

class AppBar extends Component
{
    public function render()
    {

        $menu       = MenuConstant::NAME_DASHBOARD_TOPBAR;

        return view('livewire.dashboard.layout.app-bar', compact('menu'));
    }
}
