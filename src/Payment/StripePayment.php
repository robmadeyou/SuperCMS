<?php

namespace SuperCMS\Payment;

use Stripe\Stripe;
use SuperCMS\Settings\SuperCMSSettings;

class StripePayment extends Payment
{
    public function __construct()
    {
        $settings = SuperCMSSettings::singleton();

        Stripe::setApiKey($settings->getStripeToken());
    }

    public function pay():boolean
    {
        return false;
    }
}
