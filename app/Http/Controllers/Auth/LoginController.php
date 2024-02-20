<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginEvent;
use App\Events\LogoutEvent;
use App\Http\Controllers\Controller;
use Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
   

    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }
    protected function authenticated(Request $request, $user)
    {
        event(new LoginEvent($user->id,$user->name , $user->email ,null));
    }
    
    public function logout(Request $request)
    {
        dd($request->all());
        $user = auth()->user();
        
        if ($user) {
            event(new LogoutEvent($user->id, Session::get('loginId')));
        }

        $this->guard()->logout();
        $request->session()->invalidate();
        if (! $request->is('logout')) {
            event(new LogoutEvent($user->id, Session::get('loginId')));
        }
        return $this->loggedOut($request) ?: redirect('/');
    }
}
