<?php

namespace App\Http\Livewire\Dashboard\Layout;

use App\Contracts\Constants\MenuConstant;
use Livewire\Component;

class Drawer extends Component
{
    public function render()
    {

        $menu       = MenuConstant::NAME_DASHBOARD_DRAWER;

        return view('livewire.dashboard.layout.drawer', compact('menu'));
    }
}
