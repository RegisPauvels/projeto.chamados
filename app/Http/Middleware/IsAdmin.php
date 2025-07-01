<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->user()->type !== 'admin') {
            // Redireciona para a rota adequada ou mostra erro
            return redirect()->route('login')->with('error', 'Acesso não autorizado');
        }

        return $next($request);
    }
}
