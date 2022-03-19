<?php

namespace Modules\Blog\View\Component\Form;

use Illuminate\View\Component;

class PageForm extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('blog::components.form/page-form');
    }
}