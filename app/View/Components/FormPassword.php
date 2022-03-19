<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormPassword extends Component
{
    public $name;
    public $label;
    public $value;
    public $color;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $label = null, $value = null, $color = 'red')
    {
        $this->name         = $name;
        $this->label        = $label;
        $this->value        = $value;
        $this->color        = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-password');
    }
}
