<?php

namespace Modules\Student\Http\Livewire\Dashboard;

use Modules\Student\Models\Student;
use Livewire\Component;
use Livewire\WithPagination;
use Maatwebsite\Excel\Facades\Excel;
use Modules\Student\Exports\StudentExport;
use Spatie\QueryBuilder\QueryBuilder;

class StudentDataTableComponent extends Component
{
    use WithPagination;

    public $search = '';

    public function render()
    {

        $search         = $this->search;

        $students       = Student::when($search, function ($query, $search) {
            return $query->where("first_name", 'like', '%' . $search . '%');
        })->paginate(10);

        return view('student::livewire.dashboard.student-data-table-component', [
            'students'      => $students,
        ]);
    }

    public function exportExcel()
    {
        return Excel::download(new StudentExport, 'students.xlsx');
    }
}
