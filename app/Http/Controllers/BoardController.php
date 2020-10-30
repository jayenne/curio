<?php

namespace App\Http\Controllers;

use Illuminate\Routing\Controller;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\StoreBoardRequest;
use App\Http\Requests\UpdateBoardRequest;

use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\AllowedSort;
use App\Http\QueryBuilders\RandomSort;

use League\Fractal\Pagination\IlluminatePaginatorAdapter;
use App\Transformers\Boards\BoardTransformer;
use App\Transformers\Posts\PostTransformer;

use App\Traits\CanViewModelByStatusTrait;
use App\Traits\GridErrorResponseTrait;

use Auth;
use App\User;
use App\Post;
use App\Board;

class BoardController extends Controller
{
    use CanViewModelByStatusTrait;
    use GridErrorResponseTrait;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    private $error_code = 404;
    private $error_view = 'models.boards.errors';

    protected $fillable = [
        'user_id', 'cover', 'title', 'body'
    ];
    
    public function __construct(Request $request)
    {
        if ($request->user !== null) {
            $thisUser = User::whereId($request->user)->get();
            if ($thisUser->isEmpty()) {
                $this->error_code = 422;
                $this->handleGridError($this->error_view, $this->error_code);
            }
        };
    }
    /**
     * List all boards.
     *
     * @param  array $request
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, $user_id = null)
    {
        // IF CALLING USER THEN CHECK USER EXISTS
        $auth_id = Auth::id();
        $user_id = $user_id ?? $auth_id;
        $models = QueryBuilder::for(Board::class)
            ->has('posts')
            ->when($user_id, function ($q) use ($user_id) {
                $q->Where('user_id', '=', $user_id);
            })
            ->defaultSort('-created_at')
            // ->allowedSorts([
            //     AllowedSort::custom('random', new RandomSort()),
            //     AllowedSort::field('created','created_at'),
            //     AllowedSort::field('user','iser_id'),
            //     'subscriber'
            // ])
            // ->allowedFilters([
            //     AllowedFilter::exact('page'),
            //     AllowedFilter::exact('user','user_id'),
            // ])
            ->whereHas('statuses', function ($q) use ($auth_id) {
                $q->whereIn('name', ['public','subscriber','follower','following']);
                $q->when('name' == 'private', function ($q) {
                    $q->where('user_id', '=', $auth_id);
                })->orWhere('user_id', '=', $auth_id);
                // $q->when('name' == 'subscriber', function($q){
                //     $q->where('user_id', '=', $auth_id);
                //     return $q;
                // })->orWhere('user_id','=', $auth_id);
                return $q;
            })
            ->withCount(['posts'])
            ->paginate(config('platform.pagination.boards'))
            ->appends(request()->query());

        if ($models->isNotEmpty()) {
            $collection = $models->getCollection();
            $resource = \Fractal::collection($collection)
            ->parseIncludes(['user'])
            //->parseIncludes(['user', 'media', 'post_count', 'reactions', 'posts_media', 'tags'])
            ->paginateWith(new IlluminatePaginatorAdapter($models))
            ->transformWith(new BoardTransformer)
            ->toArray();

            // IF IS AJAX REQUEST FROM FRONTEND
            if ($request->ajax()) {
                $prefix = 'models.posts.';
                $file = 'wrapper';
                $view = $prefix.$file;
                $resource = view($view)->with('data', $resource['data'])->render();
            }
            $this->logView($models);
            return $resource;
        }

        $this->handleGridError($this->error_view, $this->error_code);
    }

    /**
     * Show the specified board.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
      
    public function show(Request $request, $id)
    {
        // IF CALLING USER THEN CHECK USER EXISTS
        $auth_id = Auth::id();
        $model = QueryBuilder::for(Board::class)
            ->whereId($id)
            ->has('posts')
            ->defaultSort('-created_at')
            // ->allowedSorts([
            //     AllowedSort::custom('random', new RandomSort()),
            //     AllowedSort::field('created','created_at'),
            //     AllowedSort::field('user','user_id'),
            //     'subscriber'
            // ])
            ->allowedFilters([
                AllowedFilter::exact('page'),
            ])
            ->whereHas('statuses', function ($q) use ($auth_id) {
                $q->whereIn('name', ['public','follower','following']);
                $q->when('name' == 'private', function ($q) use ($auth_id) {
                    $q->where('user_id', '=', $auth_id);
                });
                $q->when('name' == 'subscriber', function ($q) use ($auth_id) {
                    $q->where('user_id', '=', $auth_id);
                    return $q;
                })->orWhere('user_id', '=', $auth_id);

                return $q;
            })
            ->withCount(['posts'])
            ->paginate(config('platform.pagination.boards'))
            ->appends(request()->query());
        
        if ($model->isNotEmpty()) {
            $resource = \Fractal::collection($model)
            ->parseIncludes(['user', 'posts', 'posts.user', 'post_count', 'reactions', 'tags', 'post_media'])
            ->transformWith(new BoardTransformer)
            ->toArray();

            //dd($resource);
            // IF IS AJAX REQUEST FROM FRONTEND
            if ($request->ajax()) {
                $prefix = 'models.boards.';
                $file = 'wrapper';
                $view = $prefix.$file;
                $data = $resource['data'][0]['posts']['data'];
                
                $board = ['id' => $id];
                $board += $resource['data'][0]['settings'];
                foreach ($data as $k => $item) {
                    $data[$k]['board'] = $board;
                }

                $resource = view($view)->with('data', $data)->render();
            }

            return $resource;
        }

        $model = Board::find($id);
        $this->canViewByStatus($model);
        $this->handleGridError($this->error_view, $this->error_code);
    }

    /**
     * Store the specified board.
     *
     * @param  array $request
     *
     * @return \Illuminate\Http\Response
     */
    public function store(StoreBoardRequest $request)
    {
        $id = Auth::id();
        $request['user_id'] = $id;
        $data = Board::Create($request->all());
        $data->setStatus($request['status'], 'created');
        $resource = ['success'=>true, 'message'=>'Your new board has been created', 'data' => $data];

        // // IF IS AJAX REQUEST FROM FRONTEND
        if ($request->ajax()) {
            $prefix = 'models.boards.';
            $context = 'forms';
            $seperator = '.';
            $type = 'create';
            $view = $prefix.$context.$seperator.$type;
            $returnHTML = view($view)->with('item', $resource)->render();
            
            $toast = [
                'title' => 'Success',
                'subtitle' => 'just now',
                'content' => 'Your board was create.',
                'type' => 'success',
            ];

            $resource['toast'] = $toast;
            $resource['html'] = $returnHTML;
        }
        return response()->json($resource, 201);
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function update(UpdateBoardRequest $request)
    {
        $data = Board::find($request->id);
        if (empty($data)) {
            return response()->json(array('success' => false), 404);
        }
        $data->update($request->all());
        return response()->json(array('success' => true, 'data' => $data), 202);
    }

    /**
     * Remove the specified board.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {
        $data = Board::destroy($request->id);
        return response()->json(array('success' => true, 'newlyDestroyed' => $data), 202);
    }
   
    /**
     * Re0index the specified board's pivot with post order.
     *
     * @param  int $id
     *
     * @return \Illuminate\Http\Response
     */
    public function reindex(Request $request)
    {
        $user = Auth::user();
        $board = Board::find($request->id);
        $positions = json_decode($request->positions, true);

        if (empty($board)) {
            return response()->json(array('success' => false), 204);
        }

        foreach ($positions as $key => $val) {
            $board->posts()
                ->where('post_id', $val['i'])
                ->update(['board_post.index' => $key,'board_post.position' => $val['x']]);
        }
       
        return response()->json(['success' => true, 'board' => $board, 'positions' => $positions], 202);
    }
    /**
     * Get the index name for the model.
     *
     * @return string
     */
    public function searchableAs()
    {
        return 'boards_index';
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
        $auth_id = Auth::id();
        foreach ($model as $item) {
            $isOwner = $auth_id == $item->user_id ? true : false;
            if (!$isOwner) {
                $item->updateViews();
            }
        }
        return true;
    }
}
