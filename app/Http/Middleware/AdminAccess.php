<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class AdminAccess
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
        if(Auth::check()){
            $email = Auth::user()->email;
            if( $email == "user@grtech.com.my" )
                return redirect("login");
        }else{
            return redirect("login");
        }
        return $next($request);
    }
}
