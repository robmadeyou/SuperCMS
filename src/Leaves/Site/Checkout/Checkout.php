<?php

namespace SuperCMS\Leaves\Site\Checkout;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class Checkout extends Leaf
{
    protected function getViewClass()
    {
        return CheckoutView::class;
    }

    protected function createModel()
    {
        $model = new LeafModel();

        return $model;
    }
}