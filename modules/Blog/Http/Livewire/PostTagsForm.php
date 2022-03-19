<?php

namespace Modules\Blog\Http\Livewire;

use Livewire\Component;
use Modules\Blog\Models\Tag;

class PostTagsForm extends Component
{
    public $tags;

    public function mount()
    {
        $this->tags = Tag::get()->pluck('title', 'id');
    }

    public function render()
    {
        return view('blog::livewire.post-tags-form');
    }
}
