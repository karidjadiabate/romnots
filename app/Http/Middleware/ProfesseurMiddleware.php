<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProfesseurMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check()) {
            $user = auth()->user();
            if ($user->role_id === 2) {
                return $next($request);
            } else {
                abort(403, 'Accès refusé');
            }
        } else {
            // L'utilisateur n'est pas authentifié, rediriger vers la page de connexion
            return redirect()->route('login');
        }
    }
}
