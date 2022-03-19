<?php

namespace App\View\Components;

use Illuminate\View\Component;

class FormLocalizedTextEditor extends Component
{
    public $name;
    public $label;
    public $key;
    public $height;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $label, $key = 'text-editor', $height = '200px')
    {
        $this->name     = $name;
        $this->label    = $label;
        $this->key      = $key;
        $this->height   = $height;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-localized-text-editor');
    }
}
