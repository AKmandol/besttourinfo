<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class UserCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        
        $userGuard = Auth::guard('users');

        if ($userGuard->check() && $request->path() == 'user-login') {
            return $next($request);
        }

        if ($userGuard->check() && $userGuard->user()->userType == 'user') {
            return $next($request);
        }

        return redirect('/user-login')->with('response', response()->json([
            'msg' => 'Incorrect Login Info.'
        ], 401));
    }
 

}
