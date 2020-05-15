<?php

namespace App\Http\Middleware;

use Closure;
use Auth;

class UserVerify
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
        if(!Auth::guard('user-api')->user()->hasVerifiedEmail()){
            return response()->json(['message'=>'Your email is not verified']);
        }

        return $next($request);
    }
}
