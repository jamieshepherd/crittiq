<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\User;
use App\Review;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class UserController extends Controller
{
    /**
     * Display a user profile
     *
     * @param string $id
     * @return Response
     */
    public function getProfile($id)
    {
        $user = User::where('_id', $id)->first();
        $reviews = Review::where('author.reference', $user->_id)->get();
        return view('users.profile')
            ->with('user', $user)
            ->with('reviews', $reviews);
    }

}
