<?php

namespace App\Http\Middleware;

use Illuminate\Auth\Middleware\Authenticate as Middleware;
use Tymon\JWTAuth\Facades\JWTAuth;

class Authenticate extends Middleware
{
    /**
     * Get the path the user should be redirected to when they are not authenticated.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    protected function redirectTo($request)
    {
        /*$token= $request->access_token;
        JWTAuth::setToken($token);*/
        if (! $request->expectsJson()) {
            return route('login');
        }
    }

}
