<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormLayout extends Component
{
    // public $header;
    // public $footer;
    // public $aside;


    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->header = $header;
        // $this->footer = $footer;
        // $this->aside = $aside;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('layouts.form');
    }
}
