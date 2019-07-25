<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;

class Subdomain
{
    /**
     * @param Request $request
     * @param Closure $next
     *
     * @return mixed
     */
    public function handle($request, Closure $next, $subdomain="api")
    {
        $parts = explode(".", $request->getHost());
        $request->subdomain = $parts[0];
        if($request->subdomain ===$subdomain )
            return $next($request);
    }
}