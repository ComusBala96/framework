<?php

namespace Orian\Framework\Support;

use Illuminate\Http\Request;
use Illuminate\Support\Str;

class PageResolver
{
    public static function resolve(Request $request): string
    {
        $route = $request->route()?->getName();

        if ($route) {
            return Str::replace('.', '/', $route);
        }

        return trim($request->path(), '/');
    }
}