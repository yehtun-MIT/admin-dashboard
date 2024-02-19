<?php

namespace App\Http\Controllers\Auth;

use App\Events\LoginEvent;
use App\Events\LogoutEvent;
use App\Http\Controllers\Controller;
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

    // public function __logout(Request $request)
    // {
    //     $userId = auth()->user() ? auth()->user()->id : null;
    
    //     $this->guard()->logout();
    //     $request->session()->invalidate();
    
    //     if ($userId) {
    //         event(new LogoutEvent($userId));
    //     }
    
    //     return $this->loggedOut($request) ?: redirect('/');
    // }
    
    public function logout(Request $request)
    {
        $user = auth()->user();
        
        if ($user) {
            event(new LogoutEvent($user->id, $user->login_history_id));
        }

        $this->guard()->logout();
        $request->session()->invalidate();

        return $this->loggedOut($request) ?: redirect('/');
    }
}
