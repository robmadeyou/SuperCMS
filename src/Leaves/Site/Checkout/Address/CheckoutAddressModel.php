<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use SuperCMS\Leaves\Site\Checkout\CheckoutModel;

class CheckoutAddressModel extends CheckoutModel
{
    public $openLocationByDefault = false;

    protected function getExposableModelProperties()
    {
        $properties = parent::getExposableModelProperties();

        $properties[] = 'openLocationByDefault';

        return $properties;
    }
}
