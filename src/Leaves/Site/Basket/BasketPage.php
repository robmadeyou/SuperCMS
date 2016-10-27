<?php

namespace SuperCMS\Leaves\Site\Basket;

use Rhubarb\Leaf\Leaves\Leaf;
use SuperCMS\Models\Shopping\Basket;

class BasketPage extends Leaf
{
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

        $model->basket = Basket::getCurrentBasket();

        return $model;
    }
}
