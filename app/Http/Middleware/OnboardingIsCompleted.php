<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class OnboardingIsCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response) $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if($user->role === 'personal-trainer') {
            if ($user->accepted === null) {
                return redirect()->route("onboarding.step-{$user->onboarding_current_step}");
            }
        }

        return $next($request);
    }
}
