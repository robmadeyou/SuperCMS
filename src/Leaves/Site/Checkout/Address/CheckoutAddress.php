<?php

namespace SuperCMS\Leaves\Site\Checkout\Address;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use SuperCMS\Leaves\Site\Checkout\Checkout;
use SuperCMS\Models\User\SuperCMSUser;

class CheckoutAddress extends Checkout
{
    /** @var CheckoutAddressModel $model */
    protected $model;

    protected function getViewClass()
    {
        return CheckoutAddressView::class;
    }

    protected function createModel()
    {
        return new CheckoutAddressModel();
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $loggedIn = SuperCMSUser::getLoggedInUser();

        $this->model->openLocationByDefault = $loggedIn->Locations->count() == 0;

        $this->model->nextEvent->attachHandler(function () use ($loggedIn) {
            if ($loggedIn->Locations->count() != 0) {
                throw new ForceResponseException(new RedirectResponse('../payment/'));
            }
        });
    }
}
