<?php

namespace Orian\Framework\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Orian\Framework\Services\ICO\ICO
 */
class ICOFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'orians-ico';
    }
}
