<?php

namespace App\Http\Controllers\Nodes;

use Illuminate\Http\Request;

use App\Node;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;

class NodeAPI extends Controller
{
    /**
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
     * Search for a specified term.
     *
     * @param  int  $id
     * @return Response
     */
    public static function search($category)
    {
        if(isset($_GET['query'])) {
            $term = $_GET['query'];

            $node = DB::collection('nodes')
            ->where('category', $category)
            ->where('title',  'like', '%'.$term.'%')
            ->get();

            return response()->json($node);
        }
        return null;
    }

    /**
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
