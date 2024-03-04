<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class ForceChangePassword
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
        if ($request->is('password/change') || $request->route()->named('password.change.view')) {
            return $next($request); // Si ya está en la página de cambio de contraseña, continúa.
        }
    
        if (auth()->check() && auth()->user()->must_change_password) {
            return redirect()->route('password.change.view');
        }
    
        return $next($request);
    }
    
}
