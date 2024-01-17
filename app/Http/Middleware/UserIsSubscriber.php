<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserIsSubscriber
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if ($user->role->name === 'personal-trainer') {
            if (!$user->subscribed()) {
                // Se l'utente NON ha un abbonamento
                return redirect()->route('subscribe');
            }
        }

        return $next($request);
    }
}
