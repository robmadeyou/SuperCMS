<?php

namespace SuperCMS\Leaves\Site\Checkout\Success;

use SuperCMS\Leaves\Site\Checkout\Checkout;

class CheckoutSuccess extends Checkout
{
    protected function getViewClass()
    {
        return CheckoutSuccessView::class;
    }

    protected function createModel()
    {
        return new CheckoutSuccessModel();
    }
}
