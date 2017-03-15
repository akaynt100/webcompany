<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\ACL\Role;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Create a new controller instance.
     */
    public function __construct()
    {
        $this->middleware('guest');
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
