<?php

namespace SuperCMS\Leaves\Site\Checkout\Success;

use SuperCMS\Leaves\Site\Checkout\CheckoutView;

class CheckoutSuccessView extends CheckoutView
{
    /** @var CheckoutSuccessModel */
    protected $model;

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
