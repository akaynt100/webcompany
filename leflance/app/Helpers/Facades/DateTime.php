<?php

namespace App\Helpers\Facades;
use Illuminate\Support\Facades\Facade;

/**
 * @see \Illuminate\Routing\Redirector
 */
class DateTime extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'App\Helpers\DateTimeHelper';
    }
}
