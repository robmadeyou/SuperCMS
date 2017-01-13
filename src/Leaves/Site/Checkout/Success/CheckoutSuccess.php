<?php

namespace SuperCMS\Leaves\Site\Checkout\Success;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Request\Request;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Stem\Exceptions\RecordNotFoundException;
use Rhubarb\Stem\Filters\Equals;
use SuperCMS\Leaves\Site\Checkout\Checkout;
use SuperCMS\Models\Shopping\Order;

class CheckoutSuccess extends Checkout
{
    /** @var CheckoutSuccessModel */
    protected $model;

    protected function getViewClass()
    {
        return CheckoutSuccessView::class;
    }

    protected function createModel()
    {
        return new CheckoutSuccessModel();
    }

    protected function onModelCreated()
    {
        $request = Request::current();

        if ($id = $request->get('uq')) {
            try {
                $order = Order::findFirst(new Equals('UniqueReference', $id));
                $this->model->order = $order;
            } catch (RecordNotFoundException $ex) {
                throw new ForceResponseException(new RedirectResponse('/404/'));
            }
        }

        parent::onModelCreated();
    }

    protected function redirectIfNoBasket()
    {
    }
}
