<?php

namespace SuperCMS\Leaves\Admin\ShippingType;

use Rhubarb\Leaf\Crud\Leaves\CrudLeaf;

class ShippingTypeItem extends CrudLeaf
{
    protected function getViewClass()
    {
        return ShippingTypeItemView::class;
    }

    protected function createModel()
    {
        $model = new ShippingTypeItemModel();
        return $model;
    }
}
