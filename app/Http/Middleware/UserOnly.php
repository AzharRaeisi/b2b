<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class UserOnly
{
    public function handle($request, Closure $next)
    {

        if (Auth::guard('web')->check()) {
            if (Auth::guard('web')->user()->IsUser()){
                return $next($request);
            }
        }
        return redirect()->to(url('/'))->with('errors',['Access Denied.']);
    }
}
