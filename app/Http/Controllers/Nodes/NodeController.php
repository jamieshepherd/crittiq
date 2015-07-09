<?php

namespace App\Http\Controllers\Nodes;

use Illuminate\Http\Request;

use App\Node;
use App\Http\Requests;
use App\Http\Controllers\Controller;
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

        /*
        $node = DB::collection('nodes')
            ->where('category', $category)
            ->where('slug', $slug)
            ->first();

            dd($node);
        */



        $node = Node::where('category', $category)->where('slug', $slug)->first();


        return view('nodes.show')->with('node', $node);
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
