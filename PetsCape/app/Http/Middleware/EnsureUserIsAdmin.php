<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class EnsureUserIsAdmin
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next)
    {
        if (!$request->user() || $request->user()->role !== 'admin') {
            return redirect(route('dashboard'))->with('error', 'Accès non autorisé. Vous devez être administrateur pour accéder à cette page.');
        }

        return $next($request);
    }
}
