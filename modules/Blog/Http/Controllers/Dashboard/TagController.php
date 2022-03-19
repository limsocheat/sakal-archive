<?php

namespace Modules\Blog\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Models\Tag;
use Spatie\QueryBuilder\QueryBuilder;

class TagController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {
        $tags           = QueryBuilder::for(Tag::class)->get();

        $data           = [
            'tags'      => $tags,
        ];

        return view('blog::dashboard.tags.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::dashboard.tags.create');
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
            $tag            = Tag::create($data);

            if ($tag) {
                DB::commit();
                flash()->success(__('blog::messages.tag_created'));
                return redirect()->route('dashboard.tags.index');
            }

            DB::rollBack();
            flash()->warning(__('blog::messages.tag_not_created'));
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
    public function show(Tag $tag)
    {
        return view('blog::dashboard.tags.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Tag $tag)
    {
        return view('blog::dashboard.tags.edit', compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Tag $tag)
    {
        $request->validate([
            'title'         => 'required',
        ]);

        DB::beginTransaction();

        try {

            $data           = $request->all();
            $tag->update($data);

            if ($tag) {
                DB::commit();
                flash()->success(__('blog::messages.tag_updated'));
                return redirect()->route('dashboard.tags.index');
            }

            DB::rollBack();
            flash()->warning(__('blog::messages.tag_not_updated'));
            return redirect()->back()->withInput();
        } catch (\Exception $e) {
            DB::rollback();
            flash()->error($e->getMessage());
            return redirect()->back()->withInput();
        }
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
