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
        $_id = $node->_id;

        $node = DB::collection('reviews')
            //->where('id', $id)
            ->get();

        return response()->json($node);
    }
}
