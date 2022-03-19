<?php

namespace Modules\Income\Http\Livewire;

use Livewire\Component;

class Incomeable extends Component
{

    public $type = 'customer';
    public $types = [];
    public $incomeables = [];

    public function mount()
    {
        $this->types = [
            'customer'  => __('Customer'),
            'student'   => __('Student'),
        ];
    }

    public function updatedType($value)
    {
        if ($this->type == 'customer') {
            $this->incomeables = \Modules\Customer\Models\Customer::get()->pluck('name', 'id');
        } elseif ($this->type == 'student') {
            $this->incomeables = \Modules\Student\Models\Student::all();
        }
    }

    public function render()
    {
        return view('income::livewire.incomeable');
    }
}
