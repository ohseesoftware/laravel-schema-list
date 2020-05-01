<?php

namespace Ohseesoftware\LaravelSchemaList;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Ohseesoftware\LaravelSchemaList\Skeleton\SkeletonClass
 */
class LaravelSchemaListFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravel-schema-list';
    }
}
