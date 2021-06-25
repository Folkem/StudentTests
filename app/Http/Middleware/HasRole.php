<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Http\Request;

class HasRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, string ...$roles)
    {
        /** @noinspection PhpUndefinedFieldInspection */
        if (auth()->guest() || !in_array(auth()->user()->role->name, $roles)) {
            return redirect(RouteServiceProvider::HOME);
        }

        return $next($request);
    }
}
