<?php

namespace Orian\Framework\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Orian\Framework\Helper\Helper
 */
class HelperFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'orian-helper-functions';
    }
}
