<?php

namespace Modules\Blog\View\Component\Form;

use Illuminate\View\Component;
use Modules\Blog\Models\Post;

class PostForm extends Component
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
        $statuses = Post::getStatuses();

        return view('blog::components.form/post-form', [
            'statuses' => $statuses,
        ]);
    }
}
