<?php

namespace App\Http\Controllers\Nodes;

use Illuminate\Http\Request;

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
    public static function search($category, $term)
    {
        $node = DB::collection('nodes')
            ->where('category', $category)
            ->where('title',  'like', '%'.$term.'%')
            ->get();

        return response()->json($node);
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
}
