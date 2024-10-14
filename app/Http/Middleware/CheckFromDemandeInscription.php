<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckFromDemandeInscription
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->check() && auth()->user()->from_demande_inscription) {
            // Marquer l'utilisateur comme ayant terminé cette étape
            auth()->user()->update(['from_demande_inscription' => false]);

            // Rediriger vers la page des tarifs
            return redirect()->route('nostarifs');
        }

        return $next($request);
    }
}
