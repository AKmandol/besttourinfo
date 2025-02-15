<?php

namespace App\Http\Middleware;
use Illuminate\Support\Facades\Auth;
use Closure;
use Illuminate\Http\Request;

class AdminCheck
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
        $adminGuard = Auth::guard('admins');

        if ($adminGuard->check() && $request->path() == 'admin-login') {
            return $next($request);
        }

        if ($adminGuard->check() && $adminGuard->user()->role == 'admin' && $adminGuard->user()->isActivated == "1") {
            return $next($request);
        }

        return redirect('/admin-login')->with('response', response()->json([
            'msg' => 'Incorrect Login Info.'
        ], 401));
    }
}
