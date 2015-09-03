<?php

/*
|--------------------------------------------------------------------------
| API - Nodes
|--------------------------------------------------------------------------
|
| api/v1/{category}
| - Returns all films from a category
|
| api/v1/{category}/search
| - Takes parameters :query: (search query) and :take: (amount wanted)
|
| api/v1/{category}/{slug}
| - Returns a specific node, referenced by it's unique category/slug
|
| api/v1/{category}/{slug}/reviews
| - Returns all of the reviews for a specific node
| - Takes parameters :filter: (newest, oldest) :skip: (first 10) and :take: (10)
|
*/

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;

use App\Node;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class NodeAPI extends Controller
{
    /**
     * api/v1/{category}
     * Get all of the nodes
     *
     * @return Response
     */
    public static function index($category)
    {
        $node = DB::collection('nodes')
            ->where('category', $category)
            ->get();

        return response()->json($node);
    }

    /**
     * api/v1/{category}/search
     * Search for a specified term.
     *
     * @param  string  $id
     * @return Response
     */
    public static function search($category)
    {
        if(isset($_GET['query'])) {
            $term = $_GET['query'];
            $take = (isset($_GET['take'])) ? 5 : 10;

            $node = DB::collection('nodes')
            ->where('category', $category)
            ->where('title',  'like', '%'.$term.'%')
            ->take($take)
            ->get();

            return response()->json($node);
        }
        return null;
    }

    /**
     * api/v1/{category}/{slug}
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public static function find($category, $slug)
    {
        $node = DB::collection('nodes')
            ->where('category', $category)
            ->where('slug', $slug)
            ->get();

        return response()->json($node);
    }

    /**
     * api/v1/{category}/{slug}/reviews
     * Get reviews for a node.
     *
     * @param  int  $id
     * @return Response
     */
    public static function reviews($category, $slug)
    {
        $node = Node::where('category', $category)->where('slug', $slug)->first();

        $filter = isset($_GET['filter']) ? $_GET['filter'] : null;
        $skip = isset($_GET['skip']) ? $_GET['skip'] : 0;
        $take = isset($_GET['take']) ? $_GET['take'] : 10;
        switch ($filter) {
            case 'newest':
                $reviews = DB::collection('reviews')
                    ->where('node.reference', $node->_id)
                    ->orderBy('created_at', 'desc')
                    ->skip($skip)->take($take)
                    ->get();
                break;
            case 'oldest':
                $reviews = DB::collection('reviews')
                    ->where('node.reference', $node->_id)
                    ->orderBy('created_at', 'asc')
                    ->skip($skip)->take($take)
                    ->get();
                break;
            case 'highest':
                $reviews = DB::collection('reviews')
                    ->where('node.reference', $node->_id)
                    ->orderBy('score', 'desc')
                    ->skip($skip)->take($take)
                    ->get();
                break;
            case 'lowest':
                $reviews = DB::collection('reviews')
                    ->where('node.reference', $node->_id)
                    ->orderBy('score', 'asc')
                    ->skip($skip)->take($take)
                    ->get();
                break;
            default:
                $reviews = DB::collection('reviews')
                    ->where('node.reference', $node->_id)
                    ->orderBy('created_at', 'desc')
                    ->skip($skip)->take($take)
                    ->get();
                break;
        }

        return response()->json($reviews);
    }

}
