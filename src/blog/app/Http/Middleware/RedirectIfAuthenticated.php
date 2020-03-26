<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;
use Redirect;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        switch ($guard) {
            case 'admin':
                if (Auth::guard($guard)->check()) {
                    if (Auth::guard($guard)->user()->role_id == config('define.admin')) {
                        return redirect(route('users.index'));
                    } else {
                        return redirect(route('dashboard.index'));
                    }
                }
                break;
            case 'client':
                if (Auth::guard($guard)->check()) {
                    if (Auth::guard($guard)->user()->role_id == config('define.user')) {
                        return redirect(session('link'));
                    }
                }
                break;
            default:
                if (Auth::guard($guard)->check()) {
                    return redirect()->back();
                }
                break;
        }

        return $next($request);
    }
}
