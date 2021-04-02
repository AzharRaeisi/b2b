<?php

namespace App\Http\Middleware;
use Auth;
use Closure;

class UserActive
{
    public function handle($request, Closure $next)
    {

        if (Auth::guard('web')->check()) {
            if (Auth::guard('web')->user()->IsUser()){

                if (Auth::guard('web')->user()->status == '0'){
                    return redirect()->to(url('/'))->with('errors',['Your account is currently pending approval by the site administrator. Thanks']);
                }
                if (Auth::guard('web')->user()->ban != '0'){
                    Auth::guard('web')->logout();
                    return redirect()->to(url('/'))->with('errors',['Your account is banned.']);
                }
                return $next($request);
            }
        }
        session()->flash('error','Access Denied Please login first.');
        return redirect()->to(route('user.login'))->with('errors',['Access Denied Please login first.']);
    }
}
