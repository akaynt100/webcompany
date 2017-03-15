<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ACL\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required',
            'password' => 'required',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Create a new controller instance.
     * LoginController constructor.
     */
    public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    /**
     * @return string
     */
    public function redirectTo()
    {
        $redirectTo = route('main-page');
        if (\Auth::user()->hasRole(Role::USER_ROLE)) {
            $redirectTo = route('orders.list', \Auth::user()->id);
        } elseif (\Auth::user()->hasRole(Role::ADMIN_ROLE)) {
            $redirectTo = route('admin.users');
        }

        return $redirectTo;
    }
}
