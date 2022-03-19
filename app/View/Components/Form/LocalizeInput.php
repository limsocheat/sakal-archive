<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class LocalizeInput extends Component
{

    public $name;
    public $label;
    public $id;
    public $key;
    public $item;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $id = "tab", $key = "input", $item)
    {
        $this->name     = $name;
        $this->label    = $label;
        $this->id       = $id;
        $this->key      = $key;
        $this->item    = $item;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.localize-input');
    }
}
