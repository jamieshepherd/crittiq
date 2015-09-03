<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class UserController extends Controller
{
    /**
     * Display a user profile
     *
     * @return Response
     */
    public function getProfile($id)
    {
        $user = User::where('id', $id)->first();
        return view('user.profile')->with('user', $user);
    }

}
