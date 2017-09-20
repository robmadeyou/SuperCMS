<?php

namespace SuperCMS\Leaves\Site\Checkout\Payment;

use Rhubarb\Crown\Events\Event;
use SuperCMS\Leaves\Site\Checkout\CheckoutModel;

class CheckoutPaymentModel extends CheckoutModel
{
    public $stripePubKey;

    public $paymentMadeEvent;

    public $basketAmount;
    public $email;

    public function __construct()
    {
        parent::__construct();

        $this->paymentMadeEvent = new Event();
    }

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = 'stripePubKey';
        $properties[] = 'basketAmount';
        $properties[] = 'email';

        return $properties;
    }
}
