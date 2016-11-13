<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use SuperCMS\Leaves\Site\Checkout\Checkout;

class CheckoutAddress extends Checkout
{
    protected function getViewClass()
    {
        return CheckoutAddressView::class;
    }
}
