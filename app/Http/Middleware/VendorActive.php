<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;

class VendorActive
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
        if (Auth::guard('web')->check()) {
            if (Auth::guard('web')->user()->IsVendor()){

                if (Auth::guard('web')->user()->status == '0'){
                    //return redirect()->to(url('/'))->with('errors',['Your account is currently pending approval by the site administrator. Thanks']);
                    session()->put('status_message','Your account is currently pending approval by the site administrator. Thanks');
                    return redirect()->to(route('vendor-dashboard'));
                }
                if (Auth::guard('web')->user()->ban != '0'){
                    Auth::guard('web')->logout();
                    return redirect()->to(url('/'))->with('errors',['Your account is banned.']);
                }
                return $next($request);
            }
        }
        return redirect()->to(url('/'))->with('errors',['Access Denied.']);
    }
}
