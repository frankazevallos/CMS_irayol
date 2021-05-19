<?php

namespace Modules\PaySubscriptions\Resolvers;

use Exception;

class PaymentPlatformResolver {

    protected $paymentPlatforms;

    public function __construct()
    {
        $this->paymentPlatforms = setting('paymentPlatforms');
    }

    public function resolveService($paymentPlatform)
    {   
        $servicesClass = [
            'paypal' => \Modules\PaySubscriptions\Services\PayPalService::class,
            'stripe' => \Modules\PaySubscriptions\Services\StripeService::class,
            'wompi' => \Modules\PaySubscriptions\Services\WompiService::class,
        ];

        $service = $servicesClass[$paymentPlatform];

        if ($service) {
            return resolve($service);
        }

        throw new Exception(__('paysubscriptions::global.not_in_the_configuration'));
    }
}