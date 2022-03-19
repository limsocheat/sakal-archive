<?php

namespace Modules\Student\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Student\Models\Student;

class PrintController extends Controller
{
    public function student(Request $request, Student $student)
    {


        return view('student::print.student', [
            'student'       => $student
        ]);
    }
}
