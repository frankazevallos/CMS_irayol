<?php 

namespace Modules\PaySubscriptions\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Modules\PaySubscriptions\Entities\Package;
use Modules\PaySubscriptions\Resolvers\PaymentPlatformResolver;

class PaymentController extends Controller {

    protected $paymentPlatformResolver;

    public function __construct(PaymentPlatformResolver $paymentPlatformResolver)
    {
        $this->middleware('auth');

        $this->paymentPlatformResolver = $paymentPlatformResolver;
    }

    public function pay(Request $request, Package $package)
    {
        try {
            $request->validate([
                'payment_platform' => ['required'],
            ]);

            $paymentPlatform = $this->paymentPlatformResolver->resolveService($request->payment_platform);

            session()->put('paymentPlatformId', $request->payment_platform);

            return $paymentPlatform->handlePayment($request, $package);

        } catch (\Throwable $th) {
            return redirect()->back()->with('danger', "Error: " . $th->getMessage());
        }
        
    }

    public function approval(){

    }

    public function cancelled(){

    }
}