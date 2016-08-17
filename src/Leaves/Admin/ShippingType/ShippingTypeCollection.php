<?php

namespace SuperCMS\Leaves\Admin\ShippingType;

use Rhubarb\Leaf\Leaves\Leaf;
use Rhubarb\Leaf\Leaves\LeafModel;

class ShippingTypeCollection extends Leaf
{
    protected function getViewClass()
    {
        return ShippingTypeCollectionView::class;
    }

    protected function createModel()
    {
        $model = new ShippingTypeCollectionModel();

        return $model;
    }
}
