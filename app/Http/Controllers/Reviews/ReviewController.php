<?php

namespace App\Http\Controllers\Reviews;

use Illuminate\Http\Request;

use App\Node;
use App\Review;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use DB;
use Input;

class ReviewController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function create($category, $slug)
    {
        //$node = Node::where('category', $category)->where('slug', $slug)->first();

        $review = new Review();
        $review->author = "TESTER";
        $review->score  = 8.5;
        $review->review = Input::get('review');
        $review->save();

        return redirect()->back();
    }

}
