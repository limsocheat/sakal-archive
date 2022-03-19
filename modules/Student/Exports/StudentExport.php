<?php

namespace Modules\Student\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Modules\Student\Models\Student;

class StudentExport implements FromView
{
    /**
     * @return \Illuminate\Support\Collection
     */
    public function view(): View

    {
        $students    = Student::select('*')
            ->get();

        return view('student::export.students', [
            'students' => $students,
        ]);
    }
}
