<?php

namespace App\Http\Controllers\Nodes;

use Illuminate\Http\Request;

use App\Node;
use App\Review;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class NodeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index($category, $slug)
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function show($category, $slug)
    {

        $node = Node::where('category', $category)->where('slug', $slug)->first();

        //dd($node->_id);

        $avg = number_format(round(Review::where('node', $node->_id)->avg('score'),1),1);
        if($avg == "0.0") {
            $avg = "&mdash;";
        }
        //dd($avg);
        $userReview = null;
        if(Auth::user()) {
            $userReview = Review::where('node', $node->_id)->where('author', Auth::user()->id)->first();
        }

        return view('nodes.show')->with('node', $node)->with('avg', $avg)->with('userReview', $userReview);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $slug
     * @return Response
     */
    public function edit($slug)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  string  $slug
     * @return Response
     */
    public function update($slug)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $slug
     * @return Response
     */
    public function destroy($slug)
    {
        //
    }
}
