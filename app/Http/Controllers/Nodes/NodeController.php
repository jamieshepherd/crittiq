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
    public function index($category)
    {
        return view($category.'.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create($category, $query)
    {
        $api = "http://api.themoviedb.org/3/search/movie?api_key=6bf6b9f2b6f6902c19e0e94c66c22ebb";
        $client = new \GuzzleHttp\Client();
        $response = $client->get($api, ['query' => ['query' => urlencode($query)]])->json();
        return view('nodes.create')->with('results', $response['results']);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function createConfirm($category, $id)
    {
        $result = Node::where('themoviedb_id', $id)->first();
        if(!$result) {
            $api = "http://api.themoviedb.org/3/movie/".$id."?api_key=6bf6b9f2b6f6902c19e0e94c66c22ebb";
            $client = new \GuzzleHttp\Client();
            $response = $client->get($api)->json();

            return view('nodes.createConfirm')->with('response', $response);
        } else {
            return "That already exists in the DB bro";
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store($category, $id)
    {
        $api = "http://api.themoviedb.org/3/movie/".$id."?api_key=6bf6b9f2b6f6902c19e0e94c66c22ebb";
        $client = new \GuzzleHttp\Client();
        $response = $client->get($api)->json();

        $node = new Node();
        $node->category = 'films';
        $node->imdb_id = $response['imdb_id'];
        $node->themoviedb_id = $response['id'];
        $node->slug     = \Input::get('slug');
        $node->title    = $response['title'];
        $node->release_date = $response['release_date'];
        $node->year     = date('Y',strtotime($response['release_date']));

        $node->overall_positive = 0;
        $node->overall_mixed = 0;
        $node->negative = 0;

        if(strlen($response['overview']) > 150) {
            $node->synopsis = substr($response['overview'],0,150).'...';
        } else {
            $node->synopsis = $response['overview'];
        }


        // Save the node
        $node->save();

        // Get the poster image
        if($response['poster_path']) {
            $url = 'https://image.tmdb.org/t/p/w92/'.$response['poster_path'];
            $img = 'images/uploads/films/poster/'.$node->_id.'.jpg';
            file_put_contents($img, file_get_contents($url));
            $node->poster = $node->_id.'.jpg';
        } else {
            $node->poster = $category.'.jpg';
        }

        // Get the cover image
        if($response['backdrop_path']) {
            $url = 'https://image.tmdb.org/t/p/original/'.$response['backdrop_path'];
            $img = 'images/uploads/films/cover/'.$node->_id.'.jpg';
            file_put_contents($img, file_get_contents($url));
            $node->cover = $node->_id.'.jpg';
        } else {
            $node->cover = $category.'.jpg';
        }

        // Get the director
        $api = "http://api.themoviedb.org/3/movie/".$id."/casts?api_key=6bf6b9f2b6f6902c19e0e94c66c22ebb";
        $client = new \GuzzleHttp\Client();
        $response = $client->get($api)->json();

        $directorArray = array();
        foreach($response['crew'] as $response) {
            if($response['job'] == 'Director' || $response['job'] == 'director') {
                array_push($directorArray, $response['name']);
            }
        }
        $director = implode(', ', $directorArray);
        $node->director = $director;

        $node->save();

        return redirect('/films/'.$node->slug);
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

        $userReview = null;
        if($node->reviewCount > 0 && Auth::user()) {
            $userReview = Review::where('node.reference', $node->_id)->where('author.reference', Auth::user()->id)->first();
            $userReview = $userReview->review;
        }

        return view('nodes.show')
            ->with('node', $node)
            ->with('userReview', $userReview);
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
