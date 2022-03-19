<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormTextarea extends Component
{

    public $name;
    public $label;
    public $value;
    public $placeholder;
    public $rows;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $label = null, $value = null, $placeholder = null, $rows = 4)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->rows = $rows;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-textarea');
    }
}
