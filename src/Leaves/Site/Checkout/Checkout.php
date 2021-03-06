<?php

namespace SuperCMS\Leaves\Site\Checkout;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Leaves\Leaf;
use SuperCMS\Models\Shopping\Basket;

class Checkout extends Leaf
{
    /** @var CheckoutModel */
    protected $model;

    protected function getViewClass()
    {
        throw new ForceResponseException(new RedirectResponse('/checkout/address/'));
    }

    protected function createModel()
    {
        $model = new CheckoutModel();
        return $model;
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $currentBasket = Basket::getCurrentBasket();
        if (!$currentBasket->getTotalQuantity()) {
            $this->redirectIfNoBasket();
        }

        $this->model->basket = $currentBasket;
    }

    protected function redirectIfNoBasket()
    {
        throw new ForceResponseException(new RedirectResponse('/'));
    }
}
