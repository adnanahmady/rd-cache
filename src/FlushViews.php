<?php

namespace RD\Middleware;

use Closure;
use Illuminate\Support\Facades\Cache;

/**
 * Class FlushViews
 *
 * @package RD\Middleware
 */
class FlushViews
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if (app()->environment('local')) {
            Cache::tags('rd-cache')->flush();
        }

        return $next($request);
    }
}
