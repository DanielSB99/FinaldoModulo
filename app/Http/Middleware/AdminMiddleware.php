<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
    if (!Auth::check() || Auth::user()->tipo != 1) {
        abort(403, 'Acesso negado.Apenas administradores podem realizar esta ação.');
    }
        return $next($request);
    }
}
