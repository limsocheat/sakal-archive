<?php

namespace App\View\Components;

use App\Models\Media;
use Illuminate\View\Component;

class FormFeaturedImage extends Component
{

    public $name;
    public $id;
    public $label;
    public $featured_image_url;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($name, $id = null, $label = null, $featuredImageUrl = null)
    {
        $this->label = $label ?? __('Featured Image');
        $this->name = $name;
        $this->id = $id;
        $this->featured_image_url = $featuredImageUrl;;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.form-featured-image');
    }
}
