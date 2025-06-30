<?php

namespace Orian\Framework\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @see \Orian\Framework\Constant\Constant
 */
class ConstantFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'orian-constant-functions';
    }
}
