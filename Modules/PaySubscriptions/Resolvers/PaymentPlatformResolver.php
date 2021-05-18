<?php

namespace Modules\PaySubscriptions\Resolvers;

use Exception;

class PaymentPlatformResolver {
    protected $paymentPlatforms;

    public function __construct()
    {
        $this->paymentPlatforms = setting('paymentPlatforms');
    }

    public function resolveService($paymentPlatformId)
    {
        $name = strtolower(in_array($paymentPlatformId, $$this->paymentPlatforms));

        $service = config("services.{$name}.class");

        if ($service) {
            return resolve($service);
        }

        throw new Exception('The selected payment platform is not in the configuration');
    }
}