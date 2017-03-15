<?php

namespace App\Traits\ACL;

use App\Exceptions\PermissionDeniedException;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Illuminate\Contracts\Auth\Access\Gate;
use Monolog\Handler\StreamHandler;
use Monolog\Logger;

trait ACLTrait
{
    use Authorizable;

    /**
     * @param $ability
     * @param array $arguments
     * @return bool
     * @throws PermissionDeniedException
     */
    public function can($ability, $arguments = [])
    {
        $result = app(Gate::class)->forUser($this)->check($ability, $arguments);
        if (!$result) {

            //Enter this logic
//            if (\Auth::user()->isAdmin()) {
//                return true;
//            }


            $log = new Logger('permissions');
            $log->pushHandler(new StreamHandler(storage_path('logs/permissions.log'), Logger::DEBUG));
            $log->addDebug($ability,
                [
                    'user_id' => \Auth::user()->id,
                    'ability' => $ability,
                    'meta' => debug_backtrace(DEBUG_BACKTRACE_IGNORE_ARGS, 1)
                ]);


            throw new PermissionDeniedException('Error access rights: insufficient permissions');
        }

        return $result;
    }
}