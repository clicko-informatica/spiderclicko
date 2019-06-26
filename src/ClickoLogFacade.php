<?php

namespace Clicko\SpiderClicko;

use Illuminate\Support\Facades\Facade;

class ClickoLogFacade extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'clickolog';
    }
}
