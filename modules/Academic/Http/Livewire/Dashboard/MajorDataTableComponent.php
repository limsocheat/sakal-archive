<?php

namespace Modules\Academic\Http\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithPagination;
use Modules\Academic\Models\Major;

class MajorDataTableComponent extends Component
{
    use WithPagination;

    public $search = '';
    public function render()
    {
        $search         = $this->search;
        $majors     = Major::when($search, function ($query, $search) {
            return $query->where("name", 'like', '%' . $search . '%');
        })
            ->paginate(10);
        return view('academic::livewire.dashboard.major-data-table-component', [
            'majors'     => $majors
        ]);
    }
}
