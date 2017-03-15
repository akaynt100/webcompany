<?php

namespace App\Http\Middleware;

use App\Exceptions\PermissionDeniedException;
use Closure;

class ACL
{
    /**
     * @param $request
     * @param Closure $next
     * @return mixed
     * @throws PermissionDeniedException
     */
    public function handle($request, Closure $next)
    {
        \Auth::user()->can('account.access');

        return $next($request);
    }
}
