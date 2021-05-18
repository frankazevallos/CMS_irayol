<?php 

namespace Modules\PaySubscriptions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PaymentController extends Controller {

    public function pay(Request $request, $id)
    {
        $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);

        session()->put('paymentPlatformId', $request->payment_platform);

        if ($request->user()->hasActiveSubscription()) {
            $request->value = round($request->value * 0.9, 2);
        }

        return $paymentPlatform->handlePayment($request);
    }

    public function approval(){

    }

    public function cancelled(){

    }
}