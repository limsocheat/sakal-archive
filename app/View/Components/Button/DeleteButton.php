<?php

namespace App\View\Components\Button;

use Illuminate\View\Component;

class DeleteButton extends Component
{

    public $title;
    public $confirm;
    public $action;
    public $method;
    public $class;
    public $icon;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($title, $confirm, $action, $method, $class = null, $icon = null)
    {
        $this->title = $title;
        $this->confirm = $confirm;
        $this->action = $action;
        $this->method = $method;
        $this->class = $class;
        $this->icon = $icon;
    }
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.button.delete-button');
    }
}
