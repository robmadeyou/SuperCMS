<?php

namespace SuperCMS\Leaves\Admin\ShippingType;

use SuperCMS\Leaves\Admin\AdminCrudLeaf;

class ShippingTypeItem extends AdminCrudLeaf
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
