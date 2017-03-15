<?php

namespace App\Http\Middleware;

use App\Models\ACL\Role;
use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @param  string|null $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            /**
             * Where to redirect users after login.
             * @return string
             */

            $redirectTo = route('main-page');
            if (\Auth::user()->hasRole(Role::USER_ROLE)) {
                $redirectTo = route('orders.list', \Auth::user()->id);
            } elseif (\Auth::user()->hasRole(Role::ADMIN_ROLE)) {
                $redirectTo = route('admin.users');
            }

            return redirect($redirectTo);

        }

        return $next($request);
    }
}
