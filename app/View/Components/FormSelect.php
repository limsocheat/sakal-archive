<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormSelect extends Component
{
    public $name;
    public $label;
    public $value;
    public $options = [];
    public $placeholder;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name = null, $label = null, $value = null, $options = [], $placeholder = null)
    {
        $this->name = $name;
        $this->label = $label;
        $this->value = $value;
        $this->options = $options;
        $this->placeholder = $placeholder;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-select');
    }
}
