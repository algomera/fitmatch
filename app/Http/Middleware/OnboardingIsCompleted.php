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
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();

        if(!$user->onboarding_step_1) {
            return redirect()->route('onboarding.step-1');
        }
        if(!$user->onboarding_step_2) {
            return redirect()->route('onboarding.step-2');
        }
        if(!$user->onboarding_step_3) {
            return redirect()->route('onboarding.step-3');
        }
        if(!$user->onboarding_step_4) {
            return redirect()->route('onboarding.step-4');
        }
        if(!$user->onboarding_step_5) {
            return redirect()->route('onboarding.step-5');
        }
        if(!$user->onboarding_step_6) {
            return redirect()->route('onboarding.step-6');
        }
        if(!$user->onboarding_step_7) {
            return redirect()->route('onboarding.step-7');
        }
        if(!$user->onboarding_step_8) {
            return redirect()->route('onboarding.step-8');
        }
        if(!$user->onboarding_step_9) {
            return redirect()->route('onboarding.step-9');
        }
        if(!$user->onboarding_step_10) {
            return redirect()->route('onboarding.step-10');
        }
        if(!$user->onboarding_step_11) {
            return redirect()->route('onboarding.step-11');
        }
        if(!$user->accepted) {
            return redirect()->route('onboarding.step-12');
        }

        return $next($request);
    }
}
