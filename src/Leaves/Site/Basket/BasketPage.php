<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Crown\Exceptions\ForceResponseException;
use Rhubarb\Crown\Response\RedirectResponse;
use Rhubarb\Leaf\Leaves\Leaf;
use SuperCMS\Models\Shopping\Basket;

class BasketPage extends Leaf
{
    /** @var BasketPageModel */
    protected $model;

    /**
     * @return mixed
     */
    protected function getViewClass()
    {
        return BasketPageView::class;
    }

    /**
     * @return BasketPageModel
     */
    protected function createModel()
    {
        $model = new BasketPageModel();
        return $model;
    }

    protected function onModelCreated()
    {
        parent::onModelCreated();

        $this->model->basket = Basket::getCurrentBasket();

        $this->model->toCheckoutEvent->attachHandler(function(){
            throw new ForceResponseException(new RedirectResponse('/checkout/'));
        });
    }
}
