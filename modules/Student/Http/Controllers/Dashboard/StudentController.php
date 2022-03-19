<?php

namespace Modules\Student\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Student\Models\Student;
use Spatie\QueryBuilder\QueryBuilder;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {


        return view('student::dashboard.students.index');
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('student::dashboard.students.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        DB::beginTransaction();

        try {
            $data           = $request->all();
            $student        = Student::create($data);
            if (!$student) :
                DB::rollBack();
                flash()->warning('Student not created');
                return redirect()->back();
            endif;
            DB::commit();
            flash()->success('Student created successfully');
            return redirect()->route('dashboard.students.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('student::dashboard.students.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Student $student)
    {

        $data = [
            'item'       => $student,
        ];
        return view('student::dashboard.students.edit', $data);
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Student $student)
    {
        DB::beginTransaction();

        try {
            $data           = $request->all();
            $student->update($data);

            if (!$student) :
                DB::rollBack();
                flash()->warning('Student not created');
                return redirect()->back();
            endif;
            DB::commit();
            flash()->success('Student created successfully');
            return redirect()->route('dashboard.students.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy(Student $student)
    {
        DB::beginTransaction();

        try {
            $student->delete();

            if (!$student) :
                DB::rollBack();
                flash()->warning('Student not delete');
                return redirect()->back();
            endif;
            DB::commit();
            flash()->success('Student deleted successfully');
            return redirect()->route('dashboard.students.index');
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back();
        }
    }
}
