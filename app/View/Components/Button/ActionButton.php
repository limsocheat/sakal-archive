<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class ActionButton extends Component
{
    public $title;
    public $confirm;
    public $action;
    public $method;
    public $class;
    public $icon;
    public $id;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $confirm, $action, $method, $class = null, $icon = null, $id = "modal")
    {
        $this->title = $title;
        $this->confirm = $confirm;
        $this->action = $action;
        $this->method = $method;
        $this->class = $class;
        $this->icon = $icon;
        $this->id = $id;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.action-button');
    }
}
