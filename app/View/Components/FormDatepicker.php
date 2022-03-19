<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormDatepicker extends Component
{

    public $name;
    public $label;
    public $value;
    public $placeholder;
    public $autoHide = true;
    public $buttons = false;
    public $color;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $label = null, $value = null, $placeholder = null, $autoHide = true, $buttons = false, $color = 'gray')
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->autoHide = $autoHide;
        $this->buttons = $buttons;
        $this->color = $color;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-datepicker');
    }
}
