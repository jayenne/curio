<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Http\Request;
use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\Posts\PostTransformer;

use Auth;
use App\User;
use App\Post;
use App\Board;

class PostController extends Controller
{
    /**
     * List all posts.
     *
     * @param  array $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //inRandomOrder('1234')->
        $paginator = Post::currentStatus('public')
            ->withCount(['boards','subscriptions'])
            ->paginate(config('platform.pagination.posts'));
        
        $model = $paginator->getCollection();

        $resource = \Fractal::create()
        ->collection($model)
        ->parseIncludes(['user','tags', 'media', 'mentions', 'urls', 'reactions'])
        ->transformWith(new PostTransformer)
        ->paginateWith(new IlluminatePaginatorAdapter($paginator))
        ->toArray();

        if ($request->ajax()) {
            // IF IS AJAX REQUEST FROM FRONTEND
            $view = 'models.posts.wrapper';
            $resource = view($view)->with('data', $resource['data'])->render();
        }
        return $resource;
    }
 
  
    /**
     * Show the specified post.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
      
    public function show(Request $request, $id)
    {
        $model = Post::withCount(['boards','subscriptions','media'])->find([$id]);

        $resource = \Fractal::create()
        ->collection($model)
        ->parseIncludes(['user','tags', 'media', 'mentions', 'urls', 'reactions'])
        ->transformWith(new PostTransformer)
        ->toArray();
        // IF IS AJAX REQUEST FROM FRONTEND
        if ($request->ajax()) {
            $prefix = 'models.posts.';
            $file = 'wrapper';
            $view = $prefix.$file;
            $resource = view($view)->with('item', $resource['data'][0])->render();
        }
        return $resource;
    }

    /**
     * Store the specified post.
     *
     * @param  array $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Requests\StorePostRequest $request)
    {
        $data = Post::Create($request->all());

        if ($data) {
            return response()->json(array('created' => true, 'data' => $data), 201);
        }
        return $this->response->errorBadRequest();
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(Request $request)
    {
        $data = Post::findOrFail($request->id);
        $data->update($request->all());
        return response()->json(array('success' => true, 'data' => $data), 202);
    }

    /**
     * Remove the specified post.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Post::findOrFail($request->id);
        $data->delete();
        return response()->json(array('success' => true, 'data' => $data), 202);
    }
    
    public function processPosts()
    {
        dispatch(new ProcessPosts());
    }
    
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'posts_index';
    }
    
    /**
     * Get the indexable data array for the model.
     *
     * @return array
     */
    
    public function toSearchableArray()
    {
        $array = $this->toArray();

        // Customize array...
        return $array;
    }

    /**
     * Get the value used to index the model.
     *
     * @return mixed
     */
    public function getScoutKey()
    {
        return $this->id;
    }
    
    /**
     * Log a viewed event for an collection of models.
     * @group Posts
     * @param  object $model
     * @return true
     */
    private function logView(object $model)
    {
        foreach ($model as $item) {
            $item->updateViews();
        }
        return true;
    }
}
