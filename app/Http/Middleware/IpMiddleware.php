<?php

namespace App\Http\Middleware;

use Closure;

class IpMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $whitelist = config('ipcheck.whitelist');
        $ipAddresses = explode(';', $whitelist);

        if (! in_array($request->ip(), $ipAddresses)) {
            // here instead of checking a single ip address we can do collection of ips
            //address in constant file and check with in_array function
                // return redirect('login');
                return response()->json(['ip_check' => false], 401);
            }
        return $next($request);
    }
}
