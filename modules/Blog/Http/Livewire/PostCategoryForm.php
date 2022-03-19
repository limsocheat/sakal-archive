<?php

namespace Modules\Blog\Http\Livewire;

use Livewire\Component;
use Modules\Blog\Models\Category;

class PostCategoryForm extends Component
{

    public $categories;

    public function mount()
    {
        $this->categories = Category::get()->pluck('title', 'id');
    }

    public function render()
    {
        return view('blog::livewire.post-category-form');
    }
}
