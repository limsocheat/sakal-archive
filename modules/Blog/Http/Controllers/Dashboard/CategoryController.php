<?php

namespace Modules\Blog\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Models\Category;
use Spatie\QueryBuilder\QueryBuilder;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $items          = QueryBuilder::for(Category::class)->get();

        $data           = [
            'items' => $items,
        ];

        return view('blog::dashboard.categories.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::dashboard.categories.create');
    }

    /**
     * Store a newly created resource in storage.
     * @param Request $request
     * @return Renderable
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'         => 'required',
        ]);

        DB::beginTransaction();

        try {

            $data           = $request->all();
            $category       = Category::create($data);

            if ($category) {
                DB::commit();
                flash()->success(__('blog::messages.category_created'));
                return redirect()->route('dashboard.categories.index');
            }

            DB::rollBack();
            flash()->warning(__('blog::messages.category_not_created'));
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back()->withInput();
        }
    }

    /**
     * Show the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function show($id)
    {
        return view('blog::dashboard.categories.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit($id)
    {
        return view('blog::dashboard.categories.edit');
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     * @param int $id
     * @return Renderable
     */
    public function destroy($id)
    {
        //
    }
}
