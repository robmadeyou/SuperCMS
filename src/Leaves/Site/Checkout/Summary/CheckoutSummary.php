<?php

namespace SuperCMS\Leaves\Site\Checkout\Summary;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use SuperCMS\Leaves\Site\Checkout\Checkout;

class CheckoutSummary extends Checkout
{
    protected function getViewClass()
    {
        return CheckoutSummaryView::class;
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->nextEvent->attachHandler(function(){
            throw new ForceResponseException(new RedirectResponse('../address/'));
        });
    }
}
