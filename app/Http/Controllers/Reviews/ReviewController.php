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
            $score = Input::get('score');
        }

        // If it's the first review, reward the user
        if(Review::where('node.reference', $node->_id)->count() == 0) {
            Auth::user()->points += 1000;
            Auth::user()->save();
        }

        // Create the review
        $review = new Review();
        $review->node   = array('reference' => $node->_id, 'name' => $node->title);
        $review->author = array('reference' => Auth::user()->_id, 'name' => Auth::user()->name, 'gravatar' => md5( strtolower( trim(Auth::user()->email))) );
        $review->score  = (double)$score;
        $review->review = Input::get('review');
        $review->thumbs = 0;
        $review->spoilers = Input::has('spoilers');
        $review->save();

        if($review->score < 4) {
            $node->increment('overall_negative');
        } else if($review->score < 7) {
            $node->increment('overall_mixed');
        } else {
            $node->increment('overall_positive');
        }

        $node->avg = number_format(round(Review::where('node.reference', $node->_id)->avg('score'),1),1);
        $node->increment('reviewCount');
        $node->save();

        return back();
    }

}
