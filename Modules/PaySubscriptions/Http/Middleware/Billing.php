<?php

namespace Modules\PaySubscriptions\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Modules\PaySubscriptions\Entities\Subscription;

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
                return redirect()->route('all.packages');
            }
        }

        return $next($request);
    }
}
