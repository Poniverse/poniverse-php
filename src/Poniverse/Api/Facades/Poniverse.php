<?php namespace Poniverse\Api\Facades;

use Illuminate\Support\Facades\Facade;

class Poniverse extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'poniverse.api';
    }
}