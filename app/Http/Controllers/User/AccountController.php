<?php

namespace App\Http\Controllers\User;

use Illuminate\Http\Request;

use App;
use App\User;
use App\Http\Requests;
use App\Http\Controllers\Controller;
use Auth;
use DB;

class AccountController extends Controller
{
    /**
     * Display a user account settings
     *
     * @return Response
     */
    public function getSettings()
    {
        return view('account.settings')->with('user', Auth::user());
    }

    /**
     * Display a user profile
     *
     * @return Response
     */
    public function getProfile()
    {
        if(Auth::user()) {
            return App::make('\App\Http\Controllers\User\UserController')->getProfile(Auth::user()->id);
        } else {
            return redirect('/');
        }
    }

    /**
     * Display a user history
     *
     * @return Response
     */
    public function getHistory()
    {
        return view('account.history')->with('user', Auth::user());
    }

    /**
     * Display a user password change screen
     *
     * @return Response
     */
    public function getPassword()
    {
        return view('account.password')->with('user', Auth::user());
    }

}
