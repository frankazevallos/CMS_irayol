<?php

namespace Modules\PaySubscriptions\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\PaySubscriptions\Entities\Subscription;
use Modules\PaySubscriptions\Entities\UserSubscription;

class Billing
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();
        $subscription = new Subscription;

        if (!$user->can('admin')) {
            if (!$subscription->subscribed($user->id) && !$subscription->onTrial($user->id)) {
                dd('No tienes una suscripcion');
            }
        }

        return $next($request);
    }
}
