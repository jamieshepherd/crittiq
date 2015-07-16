<?php

namespace App\Http\Controllers\Reviews;

use Illuminate\Http\Request;

use Auth;
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
        $node = Node::where('category', $category)->where('slug', $slug)->first();

        $score = 0.0;

        if(Input::get('score') == 10) {
            $score = 10;
        } else {
            $score = number_format(Input::get('score'),1);
        }

        $review = new Review();
        $review->node   = $node->_id;
        $review->author = Auth::user()->_id;
        $review->score  = (double)$score;
        $review->review = Input::get('review');
        $review->save();

        return redirect()->back();
    }

}
