<?php

namespace SuperCMS\Leaves\Site\Checkout\Payments;

use SuperCMS\Leaves\Site\Checkout\Checkout;

class CheckoutPayments extends Checkout
{
    protected function getViewClass()
    {
        return CheckoutPaymentsView::class;
    }
}
