<?php

namespace SuperCMS\Leaves\Site\Checkout\Success;

use SuperCMS\Leaves\Site\Checkout\CheckoutView;

class CheckoutSuccessView extends CheckoutView
{
    protected function getTitle()
    {
        return 'Success!';
    }

    protected function printBody()
    {
    }

    protected function printStepButtons()
    {
    }
}
