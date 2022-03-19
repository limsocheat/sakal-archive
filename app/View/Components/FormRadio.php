<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormRadio extends Component
{

    public $name;
    public $label;
    public $value;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $label = null, $value = null)
    {
        $this->name     = $name;
        $this->label    = $label;
        $this->value    = $value;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-radio');
    }
}
