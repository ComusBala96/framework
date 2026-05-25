<?php

namespace Orian\Framework\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Orians\Laravel\Support\PageResolver;

class InjectOriansPayload
{
    public function handle(Request $request, Closure $next)
    {
        view()->share('oriansPage', PageResolver::resolve($request));
        view()->share('oriansConfig', config('app.orians', []));
        view()->share('oriansLang', []);

        return $next($request);
    }
}