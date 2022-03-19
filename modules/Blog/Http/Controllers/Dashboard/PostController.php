<?php

namespace Modules\Blog\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Models\Post;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     * @return Renderable
     */
    public function index()
    {

        $posts          = QueryBuilder::for(Post::class)->get();

        $data           = [
            'posts'     => $posts,
        ];

        return view('blog::dashboard.posts.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     * @return Renderable
     */
    public function create()
    {
        return view('blog::dashboard.posts.create');
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
            $post           = Post::create($data);

            if ($post) {

                $post->categories()->sync($request->input('category_ids', []));
                $post->tags()->sync($request->input('tag_ids', []));

                DB::commit();
                flash()->success(__('blog::messages.post_created'));
                return redirect()->route('dashboard.posts.index');
            }

            DB::rollBack();
            flash()->warning(__('blog::messages.post_not_created'));
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
        return view('blog::dashboard.posts.show');
    }

    /**
     * Show the form for editing the specified resource.
     * @param int $id
     * @return Renderable
     */
    public function edit(Post $post)
    {
        $statuses = Post::getStatuses();

        return view('blog::dashboard.posts.edit', compact('post', 'statuses'));
    }

    /**
     * Update the specified resource in storage.
     * @param Request $request
     * @param int $id
     * @return Renderable
     */
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title'         => 'required',
        ]);

        DB::beginTransaction();

        try {

            $data           = $request->all();
            $post->update($data);

            if ($post) {

                $post->categories()->sync($request->input('category_ids', []));
                $post->tags()->sync($request->input('tag_ids', []));

                DB::commit();
                flash()->success(__('blog::messages.post_updated'));
                return redirect()->route('dashboard.posts.index');
            }

            DB::rollBack();
            flash()->warning(__('blog::messages.post_not_updated'));
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
