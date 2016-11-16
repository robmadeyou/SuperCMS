<?php

namespace SuperCMS\Leaves\Admin\ShippingType;

use Rhubarb\Leaf\Crud\Leaves\ModelBoundLeaf;

class ShippingTypeCollection extends ModelBoundLeaf
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
