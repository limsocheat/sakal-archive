<?php

namespace App\View\Components\Form;

use Illuminate\View\Component;

class UserForm extends Component
{

    public $type;
    public $roles = [];

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($roles, $type = null)
    {
        $this->roles = $roles ?? [];
        $this->type = $type;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form.user-form');
    }
}
