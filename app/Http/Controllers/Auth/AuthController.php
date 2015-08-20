<?php

namespace App\Http\Controllers\Auth;

use Validator;
use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\AuthenticatesAndRegistersUsers;
use Socialite;

class AuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Registration & Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users, as well as the
    | authentication of existing users. By default, this controller uses
    | a simple trait to add these behaviors. Why don't you explore it?
    |
    */

    use AuthenticatesAndRegistersUsers;

    /**
     * Create a new authentication controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'getLogout']);
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        return User::create([
            'name'     => $data['name'],
            'email'    => $data['email'],
            'password' => bcrypt($data['password']),
            'level'    => 1,
            'points'   => 10
        ]);
    }

    /**
     * Send the response after the user was authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  bool  $throttles
     * @return \Illuminate\Http\Response
     */
    protected function handleUserWasAuthenticated(Request $request, $throttles)
    {
        if ($throttles) {
            $this->clearLoginAttempts($request);
        }

        if (method_exists($this, 'authenticated')) {
            return $this->authenticated($request, Auth::user());
        }

        return back();
    }

    /**
     * Log the user out of the application.
     *
     * @return \Illuminate\Http\Response
     */
    public function getLogout()
    {
        Auth::logout();

        return back();
    }

    /**
     * Redirect the user to the GitHub authentication page.
     *
     * @return Response
     */
    public function redirectToProvider($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Obtain the user information from GitHub.
     *
     * @return Response
     */
    public function handleProviderCallback($provider)
    {
        $socialite = Socialite::driver($provider)->user();
        dd($socialite->getAvatar());
        if($provider == 'twitter') {
            $user = User::where('oauth_twitter.id', $socialite->getId())->first();
            if(!$user) {
                $user = new User();
                $oauth_twitter = [];
                $oauth_twitter['active'] = true;
                $oauth_twitter['id']     = $socialite->getId();
                $oauth_twitter['token']  = $socialite->token;
                $oauth_twitter['secret'] = $socialite->tokenSecret;
                $user->name              = $socialite->getName();
                $user->level             = 1;
                $user->points            = 10;
                $user->oauth_twitter     = $oauth_twitter;
                $user->save();
            }
            Auth::login($user);
        } elseif($provider == 'facebook') {
            $user = User::where('oauth_facebook.id', $socialite->getId())->first();
            if(!$user) {
                $user = new User();
                $oauth_facebook = [];
                $oauth_facebook['active'] = true;
                $oauth_facebook['id']     = $socialite->getId();
                $oauth_facebook['token'] = $socialite->token;
                $user->name              = $socialite->getName();
                $user->email             = $socialite->getEmail();
                $user->level             = 1;
                $user->points            = 10;
                $user->oauth_facebook = $oauth_facebook;
                $user->save();
            }
            Auth::login($user);
        } else {
            return "Sorry, that provider is not supported";
        }
        return back();
    }

}
