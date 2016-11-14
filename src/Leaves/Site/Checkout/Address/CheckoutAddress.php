<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use SuperCMS\Leaves\Site\Checkout\Checkout;

class CheckoutAddress extends Checkout
{
    protected function getViewClass()
    {
        return CheckoutAddressView::class;
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->requiredFields = [
            'Address1',
            'Address2',
            'Address3'
        ];
    }
}
