<?php

namespace SuperCMS\Controls\GlobalBasket;

use Rhubarb\Leaf\Leaves\Leaf;

class GlobalBasket extends Leaf
{
    protected function getViewClass()
    {
        return GlobalBasketView::class;
    }

    protected function createModel()
    {
        $model = new GlobalBasketModel();

        return $model;
    }
}
