<?php

namespace Modules\Blog\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Blog\Models\Post;
use Modules\Blog\Transformers\Api\V1\PostResource;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class PostController extends Controller
{

    /**
     * Posts List
     * 
     * Display post list with pagination
     * 
     * @group Blog Module
     * 
     * @queryParam page optional The page number. Example: 1
     * @queryParam per_page optional The number of items per page. Example: 10
     * @queryParam filter[title] optional The post title. Example: Hello World
     * @queryParam filter[status] optional The post status. Example: published
     * @queryParam filter[categories] optional The post categories Comma-separated. Example: annoucement, news
     * @queryParam filter[tags] optional The post tags Comma-separated. Example: cambodia, news
     */

    public function index(Request $request)
    {
        DB::beginTransaction();

        try {

            $posts      = QueryBuilder::for(Post::class)
                ->allowedFilters([
                    'title',
                    'status',
                    AllowedFilter::scope('categories', 'by_categories'),
                    AllowedFilter::scope('tags', 'by_tags'),
                ])
                ->paginate($request->input('per_page', 20));

            $posts      = PostResource::collection($posts)->response()->getData(true);

            DB::commit();
            return $this->responseSuccess($posts);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }

    /**
     * Show Post
     * 
     * Display post detail
     * 
     * @group Blog Module
     * 
     * @apiResource \Modules\Blog\Transformers\Api\V1\PostResource
     * @apiResourceModel \Modules\Blog\Models\Post
     * 
     */
    public function show(Request $request, Post $post)
    {
        DB::beginTransaction();

        try {

            $post       = new PostResource($post);

            DB::commit();
            return $this->responseSuccess($post);
        } catch (\Exception $e) {
            DB::rollback();
            return $this->responseError($e->getMessage());
        }
    }
}
