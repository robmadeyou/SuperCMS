<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use Rhubarb\Crown\Events\Event;
use Rhubarb\Leaf\Leaves\LeafModel;

class CheckoutAddressModel extends LeafModel
{
    public $stripePubKey;

    public $paymentMadeEvent;

    public $basketAmount;

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

        return $properties;
    }

}
